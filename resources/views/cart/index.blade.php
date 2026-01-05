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

/* PAGE BG */
body {
    background: var(--bg);
}

/* =====================
   CART ITEM (ROW STYLE)
===================== */
.cart-item {
    background: var(--surface);
    border-radius: 22px;
    padding: 18px;
    border: 0;
    box-shadow: 0 10px 30px rgba(0,0,0,0.06);
}

/* PRODUCT IMAGE */
.cart-img {
    width: 88px;
    height: 88px;
    border-radius: 18px;
    object-fit: cover;
    background: #f3f4f6;
}

/* PRODUCT TITLE */
.cart-item h6 {
    font-size: 16px;
    font-weight: 700;
    color: var(--text-dark);
}

/* PRICE */
.cart-price {
    font-size: 14px;
    color: var(--text-light);
}

/* =====================
   QTY CONTROLLER (DESIGNER)
===================== */
.qty-box {
    display: inline-flex;
    align-items: center;
    background: #f9fafb;
    border-radius: 999px;
    padding: 6px 18px;
    gap: 18px;
    border: 1px solid #e5e7eb;
}

.qty-btn {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: #ffffff;
    border: 1px solid #e5e7eb;
    color: var(--brand);
    font-size: 16px;
    font-weight: 700;
}

.qty-btn:hover {
    background: var(--brand);
    color: #fff;
}

.qty-value {
    font-weight: 700;
    font-size: 15px;
}

/* ITEM TOTAL */
.item-total {
    font-size: 18px;
    font-weight: 800;
    color: var(--text-dark);
}

/* DELETE */
.delete-item {
    color: #ef4444;
    font-size: 18px;
}

/* =====================
   PRICE SUMMARY (PAYMENT CARD)
===================== */
.price-card {
    border-radius: 24px;
    background: linear-gradient(180deg, #ffffff, #f9fafb);
    box-shadow: 0 20px 40px rgba(0,0,0,0.08);
}

.price-card h5 {
    font-size: 15px;
    font-weight: 800;
    letter-spacing: 0.08em;
}

.price-row {
    display: flex;
    justify-content: space-between;
    font-size: 14px;
    color: var(--text-light);
    margin-bottom: 12px;
}

.price-row strong {
    color: var(--text-dark);
}

.total-row {
    font-size: 20px;
    font-weight: 900;
    color: var(--text-dark);
}

/* =====================
   PRIMARY CTA
===================== */
.place-order-btn {
    background: linear-gradient(135deg, var(--brand), var(--brand-dark));
    border-radius: 14px;
    font-size: 16px;
    font-weight: 800;
    padding: 14px;
    box-shadow: 0 12px 25px rgba(25,135,84,0.35);
}

/* =====================
   MOBILE BUY BAR
===================== */
@media (max-width: 768px) {

    .cart-item {
        padding: 14px;
    }

    .cart-img {
        width: 70px;
        height: 70px;
    }

    .mobile-checkout {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background: #ffffff;
        padding: 14px 16px;
        box-shadow: 0 -15px 35px rgba(0,0,0,0.15);
        z-index: 2000;
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
                            <div class="cart-price">₹{{ $item->price }}</div>

                            <div class="d-flex align-items-center gap-3 mt-2">
                                <div class="qty-box">
                                    <button class="qty-btn qty-minus" data-id="{{ $item->product_id }}">−</button>
                                    <span class="qty-value">{{ $item->qty }}</span>
                                    <button class="qty-btn qty-plus" data-id="{{ $item->product_id }}">+</button>
                                </div>

                                <strong class="ms-auto item-total">
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
                            <div class="cart-price">₹{{ $item['price'] }}</div>

                            <div class="d-flex align-items-center gap-3 mt-2">
                                <div class="qty-box">
                                    <button class="qty-btn qty-minus" data-id="{{ $id }}">−</button>
                                    <span class="qty-value">{{ $item['qty'] }}</span>
                                    <button class="qty-btn qty-plus" data-id="{{ $id }}">+</button>
                                </div>

                                <strong class="ms-auto item-total">
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
                <p class="cart-price">Your cart is empty</p>
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

                        <!-- <button class="btn btn-success w-100 mt-4 py-2 fw-semibold">
                            PLACE ORDER
                        </button> -->
                        <div class="mobile-checkout d-lg-none">
    <button class="btn place-order-btn w-100 mt-4 d-none d-lg-block">
    PLACE ORDER
</button>



                        <p class="text-center cart-price mt-3 small">
                            🔒 Safe and Secure Payments
                        </p>

                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>