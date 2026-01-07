<x-app-layout>

<style>
.order-wrapper {
    background: #f4f7fb;
    min-height: 80vh;
}

/* ===== CARD ===== */
.card-box {
    background: #ffffff;
    border-radius: 20px;
    box-shadow: 0 12px 35px rgba(0,0,0,0.08);
    padding: 24px;
    margin-bottom: 24px;
}

/* ===== HEADER ===== */
.order-id {
    font-weight: 900;
    font-size: 18px;
}

.order-date {
    font-size: 14px;
    color: #6b7280;
}

.status {
    padding: 6px 14px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 700;
}

.status-placed { background:#dcfce7; color:#166534; }
.status-shipped { background:#e0f2fe; color:#075985; }
.status-delivered { background:#ede9fe; color:#5b21b6; }
.status-cancelled { background:#fee2e2; color:#7f1d1d; }

/* ===== PRODUCT ===== */
.product-row {
    display: flex;
    gap: 16px;
    padding: 16px 0;
    border-bottom: 1px solid #e5e7eb;
}

.product-row:last-child {
    border-bottom: none;
}

.product-img {
    width: 80px;
    height: 80px;
    border-radius: 14px;
    object-fit: cover;
    background: #f3f4f6;
}

.product-name {
    font-weight: 700;
    font-size: 15px;
}

.product-qty {
    font-size: 13px;
    color: #6b7280;
}

/* ===== PRICE ===== */
.price {
    font-weight: 800;
    font-size: 16px;
}

/* ===== SUMMARY ===== */
.summary-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
    font-size: 14px;
}

.summary-total {
    font-size: 18px;
    font-weight: 900;
}

/* ===== ADDRESS ===== */
.address-text {
    font-size: 14px;
    color: #374151;
}
</style>

<div class="order-wrapper py-4">
    <div class="container">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <div class="order-id">Order {{ $order->order_number }}</div>
                <div class="order-date">
                    Ordered on {{ $order->created_at->format('d M Y') }}
                </div>
            </div>

            <span class="status status-{{ $order->status }}">
                {{ ucfirst($order->status) }}
            </span>
        </div>

        <a href="{{ route('orders.index') }}" class="btn btn-outline-success btn-sm mb-4">
            ← Back to Orders
        </a>

        <div class="row g-4">

            <!-- LEFT : PRODUCTS -->
            <div class="col-12 col-lg-8">
                <div class="card-box">

                    <h6 class="fw-bold mb-3">Items in this order</h6>

                    @foreach($order->items as $item)
                        <div class="product-row">

                            <!-- IMAGE -->
           <!-- <img
    src="{{ $item->product && $item->product->image
            ? asset('storage/'.$item->product->image)
            : asset('images/placeholder.png') }}"
    class="product-img"
    alt="{{ $item->product_name }}"
> -->



                            <!-- INFO -->
                            <div class="flex-grow-1">
                                <div class="product-name">{{ $item->product_name }}</div>
                                <div class="product-qty">Qty: {{ $item->qty }}</div>
                            </div>

                            <!-- PRICE -->
                            <div class="price">
                                ₹{{ number_format($item->total, 2) }}
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

            <!-- RIGHT : SUMMARY -->
            <div class="col-12 col-lg-4">

                <!-- PRICE SUMMARY -->
                <div class="card-box">
                    <h6 class="fw-bold mb-3">Order Summary</h6>

                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span>₹{{ number_format($order->subtotal, 2) }}</span>
                    </div>

                    <div class="summary-row">
                        <span>Delivery</span>
                        <span class="text-success">Free</span>
                    </div>

                    <hr>

                    <div class="summary-row summary-total">
                        <span>Total</span>
                        <span>₹{{ number_format($order->total, 2) }}</span>
                    </div>

                    <div class="text-muted small mt-2">
                        Payment Method: {{ strtoupper($order->payment_method) }}
                    </div>
                </div>

                <!-- ADDRESS -->
                <div class="card-box">
                    <h6 class="fw-bold mb-2">Shipping Address</h6>

                    <div class="address-text">
                        <strong>{{ $order->customer_name }}</strong><br>
                        {{ $order->customer_phone }}<br><br>
                        {{ $order->shipping_address }}<br>
                        {{ $order->state }} - {{ $order->pincode }}
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

</x-app-layout>
