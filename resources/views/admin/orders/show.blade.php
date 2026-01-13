<x-admin-layout>
     <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<style>



    /* ORDER PRODUCT IMAGE */
.order-product-img {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    object-fit: cover;
    box-shadow: 0 6px 18px rgba(0,0,0,.15);
}

/* MOBILE OPTIMIZATION */
@media (max-width: 576px) {
    .order-product-img {
        width: 48px;
        height: 48px;
    }

    table th,
    table td {
        font-size: 14px;
    }
}

</style>
<h3 class="mb-4">Order  <b> {{ $order->customer_name }} </b>Details</h3>
<a href="{{ route('admin.orders.index') }}"
   class="btn btn-outline-warning btn-sm mb-4">
    ← Back
</a>

@if(session('success'))
    <div class="alert alert-success rounded-3">
        {{ session('success') }}
    </div>
@endif

<div class="row g-4">

    {{-- CUSTOMER INFO --}}
    <div class="col-lg-4">
        <div class="card shadow-sm rounded-4 h-100">
            <div class="card-body">
                <h6 class="fw-bold mb-3">Customer</h6>

                <p class="mb-1 fw-semibold">
                   Name: {{ $order->customer_name }}
                </p>
                <p class="mb-1">Number:{{ $order->customer_phone }}</p>
                <p class="mb-3"> Mail:{{ $order->customer_email }}</p>

                <hr>

                <small class="text-muted">
                    {{ $order->shipping_address }},
                    {{ $order->near_place }},
                    {{ $order->state }} - {{ $order->pincode }}
                </small>
            </div>
        </div>
    </div>

    {{-- ORDER ITEMS --}}
    <div class="col-lg-8">
        <div class="card shadow-sm rounded-4">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold mb-0">Items</h6>

                    {{-- STATUS UPDATE --}}
                    <form method="POST"
                          action="{{ route('admin.orders.status', $order) }}">
                        @csrf
                        <select name="status"
                                onchange="this.form.submit()"
                                class="form-select form-select-sm">
                            @foreach(['pending','shipped','delivered','cancelled'] as $status)
                                <option value="{{ $status }}"
                                    @selected($order->status === $status)>
                                    {{ ucfirst($status) }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>

                {{-- ITEMS TABLE --}}
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Product</th>
                                <th class="text-center">Qty</th>
                                <th class="text-end">Price</th>
                                <th class="text-end">Total</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($order->items as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        @if($item->product && $item->product->image)
                                            <img
                                                src="{{ asset('storage/'.$item->product->image) }}"
                                                class="order-product-img"
                                                alt="{{ $item->product_name }}"
                                            >
                                        @endif

                                        <div>
                                            <div class="fw-semibold">
                                                {{ $item->product_name }}
                                            </div>
                                            <small class="text-muted">
                                                ₹{{ number_format($item->price,2) }} each
                                            </small>
                                        </div>
                                    </div>
                                </td>

                                <td class="text-center fw-semibold">
                                    {{ $item->qty }}
                                </td>

                                <td class="text-end">
                                    ₹{{ number_format($item->price,2) }}
                                </td>

                                <td class="text-end fw-bold text-warning">
                                    ₹{{ number_format($item->total,2) }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <hr>

                {{-- TOTALS --}}
                <div class="d-flex justify-content-end">
                    <div style="width:260px">
                        <p class="d-flex justify-content-between mb-1">
                            <span>Subtotal</span>
                            <span>₹{{ number_format($order->subtotal,2) }}</span>
                        </p>
                        <p class="d-flex justify-content-between fw-bold fs-5">
                            <span>Total</span>
                            <span>₹{{ number_format($order->total,2) }}</span>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

</x-admin-layout>
