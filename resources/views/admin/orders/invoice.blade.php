<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: DejaVu Sans; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; border: 1px solid #ddd; }
        th { background: #f3f4f6; }
        .right { text-align: right; }
    </style>
</head>
<body>

<h2>Kodai Chocolates</h2>
<p><b>Invoice:</b> {{ $order->order_number }}</p>
<p><b>Date:</b> {{ $order->created_at->format('d M Y') }}</p>

<hr>

<p>
<b>Customer:</b> {{ $order->customer_name }}<br>
<b>Phone:</b> {{ $order->customer_phone }}<br>
<b>Email:</b> {{ $order->customer_email }}
</p>

<table>
<thead>
<tr>
    <th>Product</th>
    <th>Qty</th>
    <th>Price</th>
    <th>Total</th>
</tr>
</thead>
<tbody>
@foreach($order->items as $item)
<tr>
    <td>{{ $item->product_name }}</td>
    <td>{{ $item->qty }}</td>
    <td class="right">₹{{ $item->price }}</td>
    <td class="right">₹{{ $item->total }}</td>
</tr>
@endforeach
</tbody>
</table>

<h3 class="right">Grand Total: ₹{{ $order->total }}</h3>

</body>
</html>
