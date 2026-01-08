<x-app-layout>
    <style>
        /* =====================
   BRAND COLORS
===================== */
        :root {
            --brand: #198754;
            --brand-dark: #0f5132;
            --text-dark: #111827;
            --text-light: #6b7280;
            --surface: #ffffff;
            --bg: #f4f7fb;
        }

        /* =====================
   CART ITEM
===================== */
        .cart-item {
            background: var(--surface);
            border-radius: 20px;
            padding: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
        }

        .cart-img {
            width: 88px;
            height: 88px;
            border-radius: 16px;
            object-fit: cover;
            background: #f3f4f6;
        }

        .cart-item h6 {
            font-size: 15px;
            font-weight: 700;
            color: var(--text-dark);
        }

        .cart-price {
            font-size: 14px;
            color: var(--text-light);
        }

        /* =====================
   QTY CONTROLLER
===================== */
        .qty-box1 {
            display: inline-flex;
            align-items: center;
            gap: 14px;
            background: #f9fafb;
            border-radius: 999px;
            padding: 6px 14px;
            border: 1px solid #e5e7eb;
        }

        .qty-btn {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: #fff;
            border: 1px solid #e5e7eb;
            color: var(--brand);
            font-weight: 700;
        }

        .qty-btn:hover {
            background: var(--brand);
            color: #fff;
        }

        .qty-value {
            font-weight: 700;
            min-width: 18px;
            text-align: center;
        }

        .item-total {
            font-weight: 800;
            color: var(--text-dark);
        }

        /* DELETE */
        .delete-top {
            position: absolute;
            top: 10px;
            right: 12px;
        }

        /* =====================
   PRICE CARD
===================== */
        .price-card {
            border-radius: 22px;
            background: linear-gradient(180deg, #ffffff, #f9fafb);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
        }

        .price-card h5 {
            font-weight: 800;
            letter-spacing: .08em;
            font-size: 14px;
        }

        .total-row {
            font-size: 18px;
            font-weight: 900;
        }

        /* =====================
   CTA BUTTON
===================== */
        .place-order-btn {
            background: linear-gradient(135deg, var(--brand), var(--brand-dark));
            border-radius: 14px;
            font-size: 15px;
            font-weight: 800;
            padding: 12px;
        }

        /* =====================
   MOBILE OPTIMIZATION
===================== */
        @media (max-width: 768px) {

            .cart-img {
                width: 72px;
                height: 72px;
            }

            .cart-item {
                padding: 14px;
            }

            .qty-box1 {
                padding: 6px 10px;
                gap: 8px;
            }

            .item-total {
                font-size: 14px;
            }

            .price-card {
                position: static;
                margin-top: 16px;
            }

            .place-order-btn {
                font-size: 14px;
                padding: 10px;
            }
        }
    </style>




    <div class="container py-3">
        <div class="row g-3">

            {{-- ================= CART ITEMS ================= --}}
            <div class="col-lg-8">

                @if($useDb && $cart && $cart->items->count())

                {{-- DB CART --}}
                @foreach($cart->items as $item)
                <div class="card cart-item mb-3 border-0 shadow-sm">
                    <div class="card-body d-flex gap-3 align-items-start position-relative">

                        <!-- DELETE (TOP RIGHT) -->
                        <button class="btn btn-link text-danger delete-item delete-top"
                            data-id="{{ $item->product_id }}">
                            <i class="bi bi-trash"></i>
                        </button>

                        <img src="{{ asset('storage/'.$item->product->image) }}" class="cart-img">

                        <div class="flex-grow-1">
                            <h6 class="fw-semibold mb-1">{{ $item->product->name }}</h6>
                            <div class="cart-price mb-2">₹{{ $item->price }}</div>

                            <div class="d-flex align-items-center gap-3 mt-2">
                                <div class="qty-box1">
                                    <button class="qty-btn qty-minus" data-id="{{ $item->product_id }}">−</button>
                                    <span class="qty-value">{{ $item->qty }}</span>
                                    <button class="qty-btn qty-plus" data-id="{{ $item->product_id }}">+</button>
                                </div>

                                <strong class="ms-auto item-total">
                                    ₹{{ $item->qty * $item->price }}
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach

                @elseif(!$useDb && !empty($cart))

                {{-- SESSION CART --}}
                @foreach($cart as $id => $item)
                <div class="card cart-item mb-3 border-0 shadow-sm">
                    <div class="card-body d-flex gap-3 align-items-start position-relative">

                        <!-- DELETE (TOP RIGHT) -->
                        <button class="btn btn-link text-danger delete-item delete-top"
                            data-id="{{ $id }}">
                            <i class="bi bi-trash"></i>
                        </button>

                        <!-- IMAGE -->
                        <img src="{{ asset('storage/'.$item['image']) }}" class="cart-img">

                        <!-- CONTENT -->
                        <div class="flex-grow-1">
                            <h6 class="fw-semibold mb-1">{{ $item['name'] }}</h6>
                            <div class="cart-price mb-2">₹{{ $item['price'] }}</div>

                            <div class="d-flex align-items-center gap-3 mt-2">
                                <div class="qty-box1">
                                    <button class="qty-btn qty-minus" data-id="{{ $id }}">−</button>
                                    <span class="qty-value">{{ $item['qty'] }}</span>
                                    <button class="qty-btn qty-plus" data-id="{{ $id }}">+</button>
                                </div>

                                <strong class="ms-auto item-total">
                                    ₹{{ $item['price'] * $item['qty'] }}
                                </strong>
                            </div>
                        </div>

                    </div>
                </div>
                @endforeach


                @else
                <div class="empty-cart-wrapper">
                    <div class="empty-cart-card">
                        <i class="bi bi-cart"></i>

                        <h3>Your cart is empty</h3>
                        <p>Add some delicious products from Kodaikanal!</p>

                        <a href="{{ route('products.index') }}" class="start-shopping-btn">
                            👜 Start Shopping
                        </a>
                    </div>
                </div>
                @endif

            </div>

            {{-- ================= PRICE SUMMARY ================= --}}
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm sticky-top price-card" style="top:90px">
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
                            <span id="price">Price</span>
                            <span>₹{{ $subtotal }}</span>
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <span id="price">Delivery Charges</span>
                            <span class="text-success">Free</span>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between fw-bold mt-2">
                            <span>Total Amount</span>
                            <span id="total">₹{{ $total }}</span>
                        </div>

                      
                        <!-- @if($subtotal > 0)
                        <a href="{{ route('checkout.index') }}" class="btn place-order-btn w-100 mt-4 text-white">
                            PLACE ORDER
                        </a>
                        @else
                        <button class="btn btn-secondary w-100 mt-4" disabled>
                            Cart is empty
                        </button>
                        @endif -->
                        @if($subtotal > 0)

                            @guest
                                <!-- Guest → Open Login Modal -->
                                <button type="button"
                                        class="btn place-order-btn w-100 mt-4 text-white"
                                        data-bs-toggle="modal"
                                        data-bs-target="#loginModal">
                                    PLACE ORDER
                                </button>
                            @endguest

                            @auth
                                <!-- Logged in → Go to checkout -->
                                <a href="{{ route('checkout.index') }}"
                                class="btn place-order-btn w-100 mt-4 text-white">
                                    PLACE ORDER
                                </a>
                            @endauth

                        @else
                            <button class="btn btn-secondary w-100 mt-4" disabled>
                                Cart is empty
                            </button>
                        @endif

                        <p class="text-center cart-price mt-3 small">
                            🔒 Safe and Secure Payments
                        </p>

                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>