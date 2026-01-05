<x-app-layout>

<style>
/* =====================
   CHECKOUT DESIGN
===================== */
.checkout-item {
    background: #fff;
    border-radius: 16px;
    padding: 14px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.06);
}

.checkout-img {
    width: 70px;
    height: 70px;
    border-radius: 14px;
    object-fit: cover;
    background: #f3f4f6;
}

.checkout-title {
    font-size: 15px;
    font-weight: 700;
}

.checkout-price {
    font-size: 13px;
    color: #6b7280;
}

.checkout-total {
    font-size: 16px;
    font-weight: 800;
}

/* =====================
   PRICE CARD
===================== */
.price-card {
    border-radius: 18px;
    background: linear-gradient(180deg, #ffffff, #f9fafb);
    box-shadow: 0 14px 30px rgba(0,0,0,0.08);
}

/* =====================
   MOBILE FIXED BAR
===================== */
@media (max-width: 768px) {
    .mobile-checkout {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background: #fff;
        padding: 14px 16px;
        box-shadow: 0 -12px 30px rgba(0,0,0,0.18);
        z-index: 1000;
    }
    .placeorder{
        margin-bottom: 65px;
    }
}
</style>

<div class="container py-4">

    <h4 class="fw-bold mb-3">Checkout</h4>

    {{-- 🔔 PRICE CHANGE ALERT --}}
    @if($priceChanged)
        <div class="alert alert-warning rounded-3">
             Some product prices have changed.
            We updated your cart with the latest prices.
        </div>
    @endif

    <div class="row g-4">

        {{-- 🛒 PRODUCT LIST --}}
        <div class="col-lg-8">

            @foreach($cart->items as $item)
                @if($item->product)
                    <div class="checkout-item mb-3">

                        <div class="d-flex gap-3 align-items-center">

                            <img
                                src="{{ asset('storage/'.$item->product->image) }}"
                                class="checkout-img"
                            >

                            <div class="flex-grow-1">
                                <div class="checkout-title">
                                    {{ $item->product->name }}
                                </div>

                                <div class="checkout-price">
                                    ₹{{ $item->price }} × {{ $item->qty }}
                                </div>
                            </div>

                            <div class="checkout-total">
                                ₹{{ $item->price * $item->qty }}
                            </div>

                        </div>
                    </div>
                @endif
            @endforeach

        </div>

        {{--  PRICE SUMMARY (DESKTOP) --}}
        <div class="col-lg-4 d-none d-lg-block">
            <div class="card border-0 price-card sticky-top" style="top:90px">
                <div class="card-body">

                    <h6 class="fw-bold mb-3">PRICE DETAILS</h6>

                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal</span>
                        <span>₹{{ $cart->subtotal }}</span>
                    </div>

                    <div class="d-flex justify-content-between mb-2">
                        <span>Delivery</span>
                        <span class="text-success">Free</span>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between fw-bold fs-5">
                        <span>Total</span>
                        <span>₹{{ $cart->subtotal }}</span>
                    </div>

                    <form method="POST" action="{{ route('place.order') }}">
                        @csrf
                        <button class="btn btn-success w-100 fw-bold py-3 mt-4">
                            CONFIRM & PLACE ORDER
                        </button>
                    </form>

                </div>
            </div>
        </div>

    </div>
</div>

{{--  MOBILE FIXED CHECKOUT BAR --}}
<div class="mobile-checkout d-lg-none">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <strong>Total</strong>
        <strong>₹{{ $cart->subtotal }}</strong>
    </div>

    <form method="POST" action="{{ route('place.order') }}">
        @csrf
        <button class="btn btn-success w-100 fw-bold placeorder">
         CONFIRM PLACE ORDER
        </button>
    </form>
</div>

</x-app-layout>
