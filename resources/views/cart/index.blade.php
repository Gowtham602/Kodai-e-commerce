<x-app-layout>
<div class="container py-5">
    <div class="row g-4">

        <!-- CART ITEMS -->
        <div class="col-lg-8">

            <h4 class="fw-bold mb-4">
                Shopping Cart (<span id="cart-count">{{ count(session('cart', [])) }}</span>)
            </h4>

            @forelse(session('cart', []) as $id => $item)
                <div class="card cart-item mb-3 border-0 shadow-sm" data-id="{{ $id }}">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3">

                            <!-- Image -->
                            <img src="{{ asset('storage/'.$item['image']) }}"
                                 class="cart-img" alt="{{ $item['name'] }}">

                            <!-- Info -->
                            <div class="flex-grow-1">
                                <h6 class="fw-semibold mb-1">{{ $item['name'] }}</h6>
                                <div class="text-success fw-bold">₹{{ $item['price'] }}</div>
                            </div>

                            <!-- Quantity -->
                            <div class="qty-box">
                                <button class="qty-btn qty-minus" data-id="{{ $id }}">−</button>
                                <span class="qty-value">{{ $item['qty'] }}</span>
                                <button class="qty-btn qty-plus" data-id="{{ $id }}">+</button>
                            </div>

                            <!-- Item Total -->
                            <div class="fw-bold item-total">
                                ₹{{ $item['price'] * $item['qty'] }}
                            </div>

                            <!-- Delete -->
                            <button class="btn btn-link p-0 text-danger delete-item"
                                    data-id="{{ $id }}">
                                <i class="bi bi-trash-fill fs-5"></i>
                            </button>

                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted">Your cart is empty</p>
            @endforelse

        </div>

        <!-- PRICE SUMMARY -->
        <div class="col-lg-4">
            <div class="card price-card border-0 shadow-sm sticky-top">
                <div class="card-body">

                    <h5 class="fw-bold mb-3">PRICE DETAILS</h5>

                    @php
                        $subtotal = collect(session('cart', []))
                            ->sum(fn($i) => $i['price'] * $i['qty']);
                        $discount = 0;
                        $total = $subtotal - $discount;
                    @endphp

                    <div class="d-flex justify-content-between mb-2">
                        <span>Price</span>
                        <span id="subtotal">₹{{ $subtotal }}</span>
                    </div>

                    <!-- <div class="d-flex justify-content-between mb-2 text-success">
                        <span>Discount</span>
                        <span>-₹{{ $discount }}</span>
                    </div> -->

                    <div class="d-flex justify-content-between mb-2">
                        <span>Delivery Charges</span>
                        <span class="text-success">Free</span>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between fw-bold fs-5">
                        <span>Total Amount</span>
                        <span id="total">₹{{ $total }}</span>
                    </div>

                    <button class="btn btn-success w-100 mt-4 py-2 fw-semibold">
                        PLACE ORDER
                    </button>

                    <p class="text-center text-muted mt-3 small">
                        🔒 Safe and Secure Payments
                    </p>

                </div>
            </div>
        </div>

    </div>
</div>
</x-app-layout>
