<x-app-layout>
    <style>
        /* Cart card */
        .cart-item {
            border-radius: 14px;
        }

        /* Image */
        .cart-img {
            width: 64px;
            height: 64px;
            border-radius: 12px;
            object-fit: cover;
        }

        /* Quantity box */
        .qty-box {
            display: flex;
            align-items: center;
            gap: 10px;
            border: 1px solid #e5e7eb;
            border-radius: 20px;
            padding: 4px 10px;
        }

        .qty-btn {
            border: none;
            background: none;
            font-size: 18px;
            font-weight: 600;
            color: #166534;
        }

        .qty-value {
            min-width: 20px;
            text-align: center;
            font-weight: 600;
        }

        /* Mobile tuning */
        @media (max-width: 768px) {
            .cart-item .card-body {
                padding: 14px;
            }

            .item-total {
                font-size: 15px;
            }
        }
    </style>
   

    <div class="container py-2">
        <div class="row g-4">
            <!-- CART ITEMS -->
            <div class="col-12 col-lg-8">
                {{-- <h4 class="fw-bold mb-4">
                Shopping Cart (<span id="cart-count">{{ count(session('cart', [])) }}</span>)
                </h4> --}}
              

                @if($useDb && $cart && $cart->items->count())

    {{-- DB CART --}}
    @foreach($cart->items as $item)
        <div class="card cart-item mb-3">
            <div class="card-body">
                <img src="{{ asset('storage/'.$item->product->image) }}" class="cart-img">
                <h6>{{ $item->product->name }}</h6>
                <div>₹{{ $item->price }}</div>

                <div class="qty-box">
                    <button class="qty-minus" data-id="{{ $item->product_id }}">−</button>
                    <span class="qty-value">{{ $item->qty }}</span>
                    <button class="qty-plus" data-id="{{ $item->product_id }}">+</button>
                </div>

                <div class="item-total">
                    ₹{{ $item->qty * $item->price }}
                </div>
            </div>
        </div>
    @endforeach

@elseif(!$useDb && !empty($cart))

    {{-- SESSION CART --}}
    @foreach($cart as $id => $item)
        <div class="card cart-item mb-3">
            <div class="card-body">
                <img src="{{ asset('storage/'.$item['image']) }}" class="cart-img">
                <h6>{{ $item['name'] }}</h6>
                <div>₹{{ $item['price'] }}</div>

                <div class="qty-box">
                    <button class="qty-minus" data-id="{{ $id }}">−</button>
                    <span class="qty-value">{{ $item['qty'] }}</span>
                    <button class="qty-plus" data-id="{{ $id }}">+</button>
                </div>

                <div class="item-total">
                    ₹{{ $item['price'] * $item['qty'] }}
                </div>
            </div>
        </div>
    @endforeach

@else
    <p class="text-muted">Your cart is empty</p>
@endif




            </div>

            <!-- PRICE SUMMARY -->
            <div class="col-lg-4">
                <div class="card price-card border-0 shadow-sm sticky">
                    <div class="card-body">

                        <h5 class="fw-bold mb-3">PRICE DETAILS</h5>

                        @php
                        if ($useDb && isset($cart)) {
                        $subtotal = $cart->items->sum(fn($i) => $i->qty * $i->price);
                        } else {
                        $subtotal = collect($cart ?? [])->sum(fn($i) => $i['price'] * $i['qty']);
                        }

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