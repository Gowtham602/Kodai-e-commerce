<x-app-layout>
    <style>
        .cart-item {
            border-radius: 14px;
        }

        .cart-img {
            width: 70px;
            height: 70px;
            border-radius: 12px;
            object-fit: cover;
        }

        .qty-box {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            border: 1px solid #e5e7eb;
            border-radius: 999px;
            padding: 4px 14px;
            background: #f9fafb;
        }

        .qty-btn {
            border: none;
            background: none;
            font-size: 18px;
            font-weight: 600;
            color: #198754;
            width: 28px;
        }

        .qty-value {
            min-width: 20px;
            text-align: center;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .cart-item .card-body {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>

    <div class="container py-3">
        <div class="row g-4">

            {{-- ================= CART ITEMS ================= --}}
            <div class="col-lg-8">

                @if($useDb && $cart && $cart->items->count())

                {{-- DB CART --}}
                @foreach($cart->items as $item)
                <div class="card cart-item mb-3 border-0 shadow-sm">
                    <div class="card-body d-flex gap-3 align-items-center">

                        <img src="{{ asset('storage/'.$item->product->image) }}" class="cart-img">

                        <div class="flex-grow-1">
                            <h6 class="fw-semibold mb-1">{{ $item->product->name }}</h6>
                            <div class="text-muted">₹{{ $item->price }}</div>

                            <div class="d-flex align-items-center gap-3 mt-2">
                                <div class="qty-box">
                                    <button class="qty-btn qty-minus" data-id="{{ $item->product_id }}">−</button>
                                    <span class="qty-value">{{ $item->qty }}</span>
                                    <button class="qty-btn qty-plus" data-id="{{ $item->product_id }}">+</button>
                                </div>

                                <strong class="ms-auto">
                                    ₹{{ $item->qty * $item->price }}
                                </strong>
                            </div>
                        </div>

                        <button class="btn btn-link text-danger delete-item"
                            data-id="{{ $item->product_id }}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
                @endforeach

                @elseif(!$useDb && !empty($cart))

                {{-- SESSION CART --}}
                @foreach($cart as $id => $item)
                <div class="card cart-item mb-3 border-0 shadow-sm">
                    <div class="card-body d-flex gap-3 align-items-center">

                        <img src="{{ asset('storage/'.$item['image']) }}" class="cart-img">

                        <div class="flex-grow-1">
                            <h6 class="fw-semibold mb-1">{{ $item['name'] }}</h6>
                            <div class="text-muted">₹{{ $item['price'] }}</div>

                            <div class="d-flex align-items-center gap-3 mt-2">
                                <div class="qty-box">
                                    <button class="qty-btn qty-minus" data-id="{{ $id }}">−</button>
                                    <span class="qty-value">{{ $item['qty'] }}</span>
                                    <button class="qty-btn qty-plus" data-id="{{ $id }}">+</button>
                                </div>

                                <strong class="ms-auto">
                                    ₹{{ $item['price'] * $item['qty'] }}
                                </strong>
                            </div>
                        </div>

                        <button class="btn btn-link text-danger delete-item"
                            data-id="{{ $id }}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
                @endforeach

                @else
                <p class="text-muted">Your cart is empty</p>
                @endif

            </div>

            {{-- ================= PRICE SUMMARY ================= --}}
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm sticky-top" style="top:90px">
                    <div class="card-body">

                        <h5 class="fw-bold mb-3">PRICE DETAILS</h5>

                        @php
                        if ($useDb && $cart) {
                        $subtotal = $cart->items->sum(fn($i) => $i->qty * $i->price);
                        } else {
                        $subtotal = collect($cart ?? [])->sum(fn($i) => $i['price'] * $i['qty']);
                        }
                        $total = $subtotal;
                        @endphp

                        <div class="d-flex justify-content-between mb-2">
                            <span>Price</span>
                            <span>₹{{ $subtotal }}</span>
                        </div>

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