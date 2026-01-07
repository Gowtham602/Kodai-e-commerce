<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Order Received</title>
</head>
<body style="margin:0;padding:0;background:#f4f7fb;font-family:Arial,Helvetica,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="padding:20px 0;">
<tr>
<td align="center">

<table width="100%" cellpadding="0" cellspacing="0" style="max-width:520px;background:#ffffff;border-radius:14px;overflow:hidden;box-shadow:0 12px 30px rgba(0,0,0,.08);">

    <!-- HEADER -->
    <tr>
        <td style="background:#0f5132;color:#ffffff;padding:20px;text-align:center;">
            <h2 style="margin:0;">🛒 New Order Received</h2>
        </td>
    </tr>

    <!-- BODY -->
    <tr>
        <td style="padding:22px;color:#111827;font-size:14px;">
            <p><strong>Order ID:</strong> {{ $order->order_number }}</p>
            <p><strong>Customer:</strong> {{ $order->customer_name }}</p>
            <p><strong>Phone:</strong> {{ $order->customer_phone }}</p>
            <p><strong>Email:</strong> {{ $order->customer_email }}</p>

            <hr style="border:none;border-top:1px solid #e5e7eb;margin:14px 0;">

            <p><strong>Total:</strong> ₹{{ number_format($order->total,2) }}</p>
            <p><strong>Payment:</strong> {{ strtoupper($order->payment_method) }}</p>

            <h4 style="margin:14px 0 6px;">📍 Shipping Address</h4>
            <p style="margin:0;">
                {{ $order->shipping_address }}<br>
                {{ $order->state }} - {{ $order->pincode }}
            </p>
        </td>
    </tr>

</table>

</td>
</tr>
</table>

</body>
</html>
