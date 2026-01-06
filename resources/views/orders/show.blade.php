<x-app-layout>
<div class="container py-4">
    <h4 class="fw-bold mb-3">Order {{ $order->order_number }}</h4>
     <a href="{{ route('orders.index') }}" class="btn btn-sm btn-outline-success">
                    Back
    </a>

    @foreach($order->items as $item)
        <div class="d-flex justify-content-between border-bottom py-2">
            <span>{{ $item->product_name }} × {{ $item->qty }}</span>
            <strong>₹{{ $item->total }}</strong>
        </div>
    @endforeach

    <hr>
    <h5>Total: ₹{{ $order->total }}</h5>
</div>
</x-app-layout>
