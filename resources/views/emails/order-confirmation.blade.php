<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order Confirmation</title>
</head>
<body>
    <h2>Thank you for your order!</h2>

    <p>Your order #{{ $order->id }} has been confirmed.</p>
    <p>
        <strong>Delivery:</strong>
        {{ $order->shipping_address }}, {{ $order->shipping_city }}
        @if ($order->shipping_postal_code)
            {{ $order->shipping_postal_code }}
        @endif
    </p>

    <table width="100%" cellpadding="8" cellspacing="0" border="1" style="border-collapse: collapse;">
        <thead>
            <tr>
                <th align="left">Product</th>
                <th align="center">Qty</th>
                <th align="right">Price</th>
                <th align="right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $item)
                <tr>
                    <td>{{ $item->product_name }}</td>
                    <td align="center">{{ $item->quantity }}</td>
                    <td align="right">{{ strtoupper($order->currency) }} {{ number_format($item->unit_price, 2) }}</td>
                    <td align="right">{{ strtoupper($order->currency) }} {{ number_format($item->line_total, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p><strong>Total:</strong> {{ strtoupper($order->currency) }} {{ number_format($order->total_amount, 2) }}</p>
    <p>We will process your order soon.</p>
</body>
</html>
