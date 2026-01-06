<x-app-layout>
<div class="container py-4">
    <h4 class="fw-bold mb-4">My Orders</h4>
    <!-- <a href="{{ route('orders.index') }}" Back </a> -->
   

    @forelse($orders as $order)
        <div class="card mb-3">
            <div class="card-body d-flex justify-content-between">
                <div>
                    <strong>{{ $order->order_number }}</strong><br>
                    <small>{{ $order->created_at->format('d M Y') }}</small>
                </div>
                <div>
                    ₹{{ $order->total }}<br>
                    <span class="badge bg-success">{{ ucfirst($order->status) }}</span>
                </div>
                <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-outline-success">
                    View
                </a>
            </div>
        </div>
    @empty
        <p>No orders yet.</p>
    @endforelse
</div>
</x-app-layout>
