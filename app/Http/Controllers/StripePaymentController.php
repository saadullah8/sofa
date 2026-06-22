<?php

namespace App\Http\Controllers;

use App\Helpers\Cart;
use App\Mail\OrderConfirmationMail;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\Webhook;

class StripePaymentController extends Controller
{
    public function checkout(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_email' => ['required', 'email', 'max:255'],
            'customer_phone' => ['required', 'string', 'max:30'],
            'shipping_address' => ['required', 'string', 'max:255'],
            'shipping_city' => ['required', 'string', 'max:120'],
            'shipping_postal_code' => ['nullable', 'string', 'max:30'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        if (! Cart::exists()) {
            return redirect()
                ->route('user.cart')
                ->with('error', 'Your cart is empty.');
        }

        if (! $this->cartStockIsAvailable()) {
            return redirect()
                ->route('user.cart')
                ->with('error', 'Some cart items are no longer available in the requested quantity.');
        }

        if (! config('services.stripe.secret')) {
            return redirect()
                ->route('user.cart')
                ->with('error', 'Stripe secret key is not configured.');
        }

        Stripe::setApiKey(config('services.stripe.secret'));
        $order = $this->createPendingOrder($validated);

        try {
            $session = Session::create([
                'payment_method_types' => ['card'],
                'mode' => 'payment',
                'customer_email' => $order->customer_email,
                'line_items' => $this->lineItems(),
                'metadata' => [
                    'order_id' => $order->id,
                ],
                'success_url' => route('payment.success', [], true) . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('payment.cancel', [], true),
            ]);

            $order->update([
                'stripe_session_id' => $session->id,
            ]);
        } catch (\Throwable $e) {
            $order->update([
                'status' => 'failed',
                'payment_status' => 'failed',
            ]);

            return redirect()
                ->route('user.cart')
                ->with('error', 'Unable to start Stripe checkout. Please try again.');
        }

        return redirect($session->url);
    }

    public function success(Request $request)
    {
        $request->validate([
            'session_id' => ['required', 'string'],
        ]);

        if (! config('services.stripe.secret')) {
            return redirect()
                ->route('user.cart')
                ->with('error', 'Stripe secret key is not configured.');
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $session = Session::retrieve($request->session_id);
        } catch (\Throwable $e) {
            return redirect()
                ->route('user.cart')
                ->with('error', 'Unable to verify Stripe payment.');
        }

        if ($session->payment_status !== 'paid') {
            return redirect()
                ->route('user.cart')
                ->with('error', 'Payment was not completed.');
        }

        $this->completeOrderFromSession($session);
        Cart::clear();

        return redirect()
            ->route('user.cart')
            ->with('success', 'Payment successful. Thank you for your order.');
    }

    public function cancel()
    {
        return redirect()
            ->route('user.cart')
            ->with('error', 'Payment cancelled.');
    }

    public function webhook(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $endpointSecret = config('services.stripe.webhook_secret');

        try {
            $event = $endpointSecret
                ? Webhook::constructEvent($payload, $sigHeader, $endpointSecret)
                : json_decode($payload);
        } catch (\Exception $e) {
            return response('Invalid webhook', 400);
        }

        if (! $event) {
            return response('Invalid webhook', 400);
        }

        if ($event->type === 'checkout.session.completed') {
            $this->completeOrderFromSession($event->data->object);

            return response('Checkout session completed', 200);
        }

        return response('Webhook handled', 200);
    }

    private function lineItems(): array
    {
        return collect(Cart::products())
            ->map(function ($product) {
                return [
                    'price_data' => [
                        'currency' => config('services.stripe.currency', 'usd'),
                        'product_data' => [
                            'name' => $product->name,
                        ],
                        'unit_amount' => (int) round($product->price * 100),
                    ],
                    'quantity' => $product->qty,
                ];
            })
            ->values()
            ->all();
    }

    private function createPendingOrder(array $customerDetails): Order
    {
        $user = Auth::user();
        $order = Order::create([
            'user_id' => $user?->id,
            'customer_name' => $customerDetails['customer_name'],
            'customer_email' => $customerDetails['customer_email'],
            'customer_phone' => $customerDetails['customer_phone'],
            'shipping_address' => $customerDetails['shipping_address'],
            'shipping_city' => $customerDetails['shipping_city'],
            'shipping_postal_code' => $customerDetails['shipping_postal_code'] ?? null,
            'notes' => $customerDetails['notes'] ?? null,
            'subtotal' => Cart::subTotal(),
            'shipping' => Cart::shipping(),
            'discount' => Cart::discount(),
            'total_amount' => Cart::grandTotal(),
            'currency' => config('services.stripe.currency', 'usd'),
            'status' => 'pending',
            'payment_status' => 'unpaid',
        ]);

        foreach (Cart::products() as $product) {
            $order->items()->create([
                'product_id' => $product->id,
                'product_name' => $product->name,
                'quantity' => $product->qty,
                'unit_price' => $product->price,
                'line_total' => $product->price * $product->qty,
            ]);
        }

        return $order;
    }

    private function completeOrderFromSession(object $session): void
    {
        $orderId = $session->metadata->order_id ?? null;
        $order = $orderId
            ? Order::with('items')->find($orderId)
            : Order::with('items')->where('stripe_session_id', $session->id)->first();

        if (! $order) {
            return;
        }

        $wasPaid = $order->payment_status === 'paid';
        $customerDetails = $session->customer_details ?? null;
        $customerEmail = $customerDetails->email ?? $order->customer_email;
        $customerName = $customerDetails->name ?? $order->customer_name;

        $order->update([
            'customer_name' => $customerName,
            'customer_email' => $customerEmail,
            'status' => 'confirmed',
            'payment_status' => 'paid',
            'stripe_session_id' => $session->id,
            'stripe_payment_intent_id' => $session->payment_intent ?? $order->stripe_payment_intent_id,
            'paid_at' => $order->paid_at ?? now(),
        ]);

        if (! $wasPaid) {
            $this->decreaseProductStock($order->fresh('items.product'));
        }

        if ($customerEmail && ! $order->mail_sent_at) {
            try {
                Mail::to($customerEmail)->send(new OrderConfirmationMail($order->fresh('items')));

                $order->update([
                    'mail_sent_at' => now(),
                ]);
            } catch (\Throwable $e) {
                Log::error('Order confirmation mail failed', [
                    'order_id' => $order->id,
                    'message' => $e->getMessage(),
                ]);
            }
        }
    }

    private function cartStockIsAvailable(): bool
    {
        foreach (Cart::products() as $item) {
            if ($item->stock < $item->qty) {
                return false;
            }
        }

        return true;
    }

    private function decreaseProductStock(Order $order): void
    {
        foreach ($order->items as $item) {
            if ($item->product) {
                $item->product->decrement('stock', min($item->quantity, $item->product->stock));
            }
        }
    }
}
