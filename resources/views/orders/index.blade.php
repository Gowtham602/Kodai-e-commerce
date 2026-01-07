<x-app-layout>

<style>
/* ===== PAGE ===== */
.orders-page {
    background: #f4f7fb;
    min-height: 80vh;
}

/* ===== ORDER CARD ===== */
.order-card {
    background: #ffffff;
    border-radius: 20px;
    padding: 22px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.06);
    transition: all .25s ease;
    height: 100%;
}

.order-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 18px 45px rgba(0,0,0,0.12);
}

/* ===== HEADER ===== */
.order-id {
    font-weight: 800;
    font-size: 15px;
    color: #111827;
}

.order-date {
    font-size: 13px;
    color: #6b7280;
}

/* ===== STATUS ===== */
.status {
    display: inline-block;
    padding: 6px 14px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 700;
}

.status-placed { background:#dcfce7; color:#166534; }
.status-shipped { background:#e0f2fe; color:#075985; }
.status-delivered { background:#ede9fe; color:#5b21b6; }
.status-cancelled { background:#fee2e2; color:#7f1d1d; }

/* ===== ITEMS ===== */
.order-items {
    font-size: 14px;
    color: #374151;
    margin-top: 12px;
}

/* ===== PRICE ===== */
.order-price {
    font-size: 20px;
    font-weight: 900;
    color: #111827;
}

/* ===== BUTTON ===== */
.view-btn {
    background: linear-gradient(135deg, #198754, #0f5132);
    border-radius: 999px;
    padding: 10px 22px;
    font-size: 14px;
    font-weight: 800;
    color: #fff;
    border: none;
}

.view-btn:hover {
    opacity: .95;
}
</style>

<div class="orders-page py-4">
    <div class="container">

      <h4 class="fw-bold text-center text-center-md-start mb-4">Orders History</h4>


        <div class="row g-4">

            @forelse($orders as $order)
                <!-- CARD -->
                <div class="col-12 col-md-6">
                    <div class="order-card">

                        <!-- TOP -->
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <div class="order-id">{{ $order->order_number }}</div>
                                <div class="order-date">
                                    Ordered on {{ $order->created_at->format('d M Y') }}
                                </div>
                            </div>

                            <span class="status status-{{ $order->status }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>

                        <!-- ITEMS -->
                        <div class="order-items">
                            @foreach($order->items->take(2) as $item)
                                • {{ $item->product_name }} × {{ $item->qty }} <br>
                            @endforeach

                            @if($order->items->count() > 2)
                                <span class="text-muted">
                                    + {{ $order->items->count() - 2 }} more items
                                </span>
                            @endif
                        </div>

                        <hr>

                        <!-- BOTTOM -->
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="order-price">
                                    ₹{{ number_format($order->total, 2) }}
                                </div>
                                <div class="text-muted small">
                                    Payment: {{ strtoupper($order->payment_method) }}
                                </div>
                            </div>

                            <a href="{{ route('orders.show', $order) }}" class="view-btn">
                                View Order
                            </a>
                        </div>

                    </div>
                </div>
            @empty
                <!-- EMPTY -->
                <div class="col-12 text-center py-5">
                    <h5 class="fw-bold">No orders yet</h5>
                    <p class="text-muted">You haven’t placed any orders.</p>
                    <a href="{{ route('home') }}" class="btn btn-success rounded-pill px-4">
                        Start Shopping
                    </a>
                </div>
            @endforelse

        </div>
    </div>
</div>

</x-app-layout>
