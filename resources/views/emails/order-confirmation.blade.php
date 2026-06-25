<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order Confirmation</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f6f8; color: #222222; font-family: Arial, Helvetica, sans-serif;">
    @php
        $currency = strtoupper($order->currency);
    @endphp

    <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="background-color: #f4f6f8; margin: 0; padding: 24px 0;">
        <tr>
            <td align="center">
                <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="max-width: 680px; background-color: #ffffff; border-collapse: collapse;">
                    <tr>
                        <td style="background-color: #fe980f; padding: 24px 30px;">
                            <h1 style="margin: 0; color: #ffffff; font-size: 26px; line-height: 32px;">Chairhub</h1>
                            <p style="margin: 6px 0 0; color: #fff7eb; font-size: 14px;">Order confirmation</p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 30px;">
                            <h2 style="margin: 0 0 10px; color: #222222; font-size: 24px; line-height: 30px;">Thank you for your order, {{ $order->customer_name }}.</h2>
                            <p style="margin: 0; color: #666666; font-size: 15px; line-height: 24px;">
                                We have received your order and will process it soon. Your order number is
                                <strong style="color: #222222;">#{{ $order->id }}</strong>.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 0 30px 24px;">
                            <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse: collapse;">
                                <tr>
                                    <td width="50%" valign="top" style="padding: 16px; border: 1px solid #e5e7eb;">
                                        <h3 style="margin: 0 0 12px; color: #222222; font-size: 16px;">Customer Details</h3>
                                        <p style="margin: 0; color: #555555; font-size: 14px; line-height: 22px;">
                                            <strong>Name:</strong> {{ $order->customer_name }}<br>
                                            <strong>Email:</strong> {{ $order->customer_email }}<br>
                                            <strong>Phone:</strong> {{ $order->customer_phone }}<br>
                                            <strong>Payment:</strong> {{ ucfirst($order->payment_status) }}
                                        </p>
                                    </td>
                                    <td width="50%" valign="top" style="padding: 16px; border: 1px solid #e5e7eb; border-left: 0;">
                                        <h3 style="margin: 0 0 12px; color: #222222; font-size: 16px;">Delivery Details</h3>
                                        <p style="margin: 0; color: #555555; font-size: 14px; line-height: 22px;">
                                            {{ $order->shipping_address }}<br>
                                            {{ $order->shipping_city }}
                                            @if ($order->shipping_postal_code)
                                                , {{ $order->shipping_postal_code }}
                                            @endif
                                            @if ($order->notes)
                                                <br><strong>Notes:</strong> {{ $order->notes }}
                                            @endif
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 0 30px 24px;">
                            <h3 style="margin: 0 0 12px; color: #222222; font-size: 18px;">Order Summary</h3>
                            <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse: collapse; border: 1px solid #e5e7eb;">
                                <thead>
                                    <tr>
                                        <th align="left" style="padding: 12px; background-color: #f8fafc; color: #555555; font-size: 13px; border-bottom: 1px solid #e5e7eb;">Product</th>
                                        <th align="center" style="padding: 12px; background-color: #f8fafc; color: #555555; font-size: 13px; border-bottom: 1px solid #e5e7eb;">Qty</th>
                                        <th align="right" style="padding: 12px; background-color: #f8fafc; color: #555555; font-size: 13px; border-bottom: 1px solid #e5e7eb;">Price</th>
                                        <th align="right" style="padding: 12px; background-color: #f8fafc; color: #555555; font-size: 13px; border-bottom: 1px solid #e5e7eb;">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->items as $item)
                                        <tr>
                                            <td style="padding: 14px 12px; color: #222222; font-size: 14px; border-bottom: 1px solid #e5e7eb;">{{ $item->product_name }}</td>
                                            <td align="center" style="padding: 14px 12px; color: #555555; font-size: 14px; border-bottom: 1px solid #e5e7eb;">{{ $item->quantity }}</td>
                                            <td align="right" style="padding: 14px 12px; color: #555555; font-size: 14px; border-bottom: 1px solid #e5e7eb;">{{ $currency }} {{ number_format($item->unit_price, 2) }}</td>
                                            <td align="right" style="padding: 14px 12px; color: #222222; font-size: 14px; border-bottom: 1px solid #e5e7eb;">{{ $currency }} {{ number_format($item->line_total, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 0 30px 30px;">
                            <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse: collapse;">
                                <tr>
                                    <td align="right" style="padding: 4px 0; color: #555555; font-size: 14px;">Subtotal:</td>
                                    <td align="right" width="150" style="padding: 4px 0; color: #222222; font-size: 14px;">{{ $currency }} {{ number_format($order->subtotal, 2) }}</td>
                                </tr>
                                <tr>
                                    <td align="right" style="padding: 4px 0; color: #555555; font-size: 14px;">Shipping:</td>
                                    <td align="right" width="150" style="padding: 4px 0; color: #222222; font-size: 14px;">{{ $currency }} {{ number_format($order->shipping, 2) }}</td>
                                </tr>
                                <tr>
                                    <td align="right" style="padding: 4px 0; color: #555555; font-size: 14px;">Discount:</td>
                                    <td align="right" width="150" style="padding: 4px 0; color: #222222; font-size: 14px;">{{ $currency }} {{ number_format($order->discount, 2) }}</td>
                                </tr>
                                <tr>
                                    <td align="right" style="padding: 12px 0 0; color: #222222; font-size: 18px; font-weight: bold; border-top: 1px solid #e5e7eb;">Total:</td>
                                    <td align="right" width="150" style="padding: 12px 0 0; color: #fe980f; font-size: 18px; font-weight: bold; border-top: 1px solid #e5e7eb;">{{ $currency }} {{ number_format($order->total_amount, 2) }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 22px 30px; background-color: #f8fafc; color: #666666; font-size: 13px; line-height: 20px;">
                            <p style="margin: 0;">Thanks for shopping with Chairhub. We will contact you if we need any more information about your order.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
