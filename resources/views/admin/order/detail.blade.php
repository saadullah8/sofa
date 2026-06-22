@extends('layout.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Order #{{ $order->id }}</h5>
        </div>
        <div class="card-body">
            <p><strong>Customer:</strong> {{ $order->customer_name ?? 'Guest' }}</p>
            <p><strong>Email:</strong> {{ $order->customer_email ?? '-' }}</p>
            <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
            <p><strong>Payment:</strong> {{ ucfirst($order->payment_status) }}</p>
            <p><strong>Stripe Session:</strong> {{ $order->stripe_session_id ?? '-' }}</p>
            <p><strong>Stripe Payment Intent:</strong> {{ $order->stripe_payment_intent_id ?? '-' }}</p>
            <p><strong>Paid At:</strong> {{ $order->paid_at ? $order->paid_at->format('Y-m-d H:i') : '-' }}</p>
            <p><strong>Mail Sent At:</strong> {{ $order->mail_sent_at ? $order->mail_sent_at->format('Y-m-d H:i') : '-' }}</p>

            <div class="table-responsive mt-4">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Unit Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $item)
                            <tr>
                                <td>{{ $item->product_name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ strtoupper($order->currency) }} {{ number_format($item->unit_price, 2) }}</td>
                                <td>{{ strtoupper($order->currency) }} {{ number_format($item->line_total, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <p><strong>Subtotal:</strong> {{ strtoupper($order->currency) }} {{ number_format($order->subtotal, 2) }}</p>
            <p><strong>Shipping:</strong> {{ strtoupper($order->currency) }} {{ number_format($order->shipping, 2) }}</p>
            <p><strong>Discount:</strong> {{ strtoupper($order->currency) }} {{ number_format($order->discount, 2) }}</p>
            <p><strong>Total:</strong> {{ strtoupper($order->currency) }} {{ number_format($order->total_amount, 2) }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('order.index') }}" class="btn btn-primary">Back</a>
        </div>
    </div>
@endsection
