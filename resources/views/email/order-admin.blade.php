<h2>New Order Received</h2>

<p><strong>Order:</strong> {{ $order->order_number }}</p>
<p><strong>Customer:</strong> {{ $order->customer_name }}</p>
<p><strong>Phone:</strong> {{ $order->customer_phone }}</p>
<p><strong>Total:</strong> ₹{{ $order->total }}</p>
