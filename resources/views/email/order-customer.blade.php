<h2>Thank you for your order!</h2>

<p>Hello {{ $order->customer_name }},</p>

<p>Your order <strong>{{ $order->order_number }}</strong> has been placed successfully.</p>

<p><strong>Total:</strong> ₹{{ $order->total }}</p>

<h4>Shipping Address</h4>
<p>
    {{ $order->shipping_address }}<br>
    {{ $order->state }} - {{ $order->pincode }}
</p>

<p>We’ll deliver your order soon 🚚</p>

<p>— Kodai Chocolates 🍫</p>
