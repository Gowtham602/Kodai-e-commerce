<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Order Confirmed</title>
</head>
<body style="margin:0;padding:0;background:#f4f7fb;font-family:Arial,Helvetica,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="padding:20px 0;">
<tr>
<td align="center">

<!-- CARD -->
<table width="100%" cellpadding="0" cellspacing="0" style="max-width:520px;background:#ffffff;border-radius:14px;overflow:hidden;box-shadow:0 12px 30px rgba(0,0,0,.08);">

    <!-- HEADER -->
    <tr>
        <td style="background:#16a34a;color:#ffffff;padding:22px;text-align:center;">
            <h2 style="margin:0;font-size:22px;">✅ Order Placed Successfully</h2>
            <p style="margin:6px 0 0;font-size:14px;">
                Thank you for shopping with <strong>Kodai Chocolates</strong>
            </p>
        </td>
    </tr>

    <!-- BODY -->
    <tr>
        <td style="padding:24px;color:#111827;font-size:14px;line-height:1.6;">
            <p>Hello <strong>{{ $order->customer_name }}</strong>,</p>

            <p>
                Your order <strong>{{ $order->order_number }}</strong> has been placed successfully 🎉
            </p>

            <!-- SUMMARY -->
            <table width="100%" cellpadding="0" cellspacing="0" style="background:#f9fafb;border-radius:10px;padding:16px;margin:16px 0;">
                <tr>
                    <td style="padding:6px 0;">💰 <strong>Total Paid</strong></td>
                    <td align="right"><strong>₹{{ number_format($order->total,2) }}</strong></td>
                </tr>
                <tr>
                    <td style="padding:6px 0;">💳 <strong>Payment</strong></td>
                    <td align="right">{{ strtoupper($order->payment_method) }}</td>
                </tr>
            </table>

            <!-- ADDRESS -->
            <h4 style="margin:16px 0 6px;">📍 Shipping Address</h4>
            <p style="margin:0;color:#374151;">
                {{ $order->shipping_address }}<br>
                {{ $order->state }} - {{ $order->pincode }}
            </p>

            <p style="margin-top:16px;">
                🚚 We’ll deliver your order soon.
            </p>
        </td>
    </tr>

    <!-- FOOTER -->
    <tr>
        <td style="padding:16px;text-align:center;font-size:12px;color:#6b7280;">
            With ❤️ from <strong>Kodai Chocolates</strong><br>
            Premium chocolates inspired by Kodaikanal
        </td>
    </tr>

</table>
<!-- /CARD -->

</td>
</tr>
</table>

</body>
</html>
