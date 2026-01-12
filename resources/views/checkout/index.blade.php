<x-app-layout>
<style>
:root{
    --brand:#16a34a;
    --bg:#f8fafc;
    --muted:#6b7280;
}
body{background:var(--bg);}

/* ---------- STEPS ---------- */
.checkout-steps{
    display:flex;
    gap:12px;
    margin-bottom:24px;
}
.checkout-steps .step{
    flex:1;
    padding:14px;
    border-radius:14px;
    text-align:center;
    background:#e5e7eb;
    color:#6b7280;
    font-weight:600;
}
.checkout-steps .step span{
    display:inline-flex;
    width:34px;height:34px;
    align-items:center;justify-content:center;
    border-radius:50%;
    background:#d1d5db;
    margin-bottom:6px;
}
.checkout-steps .step.active{
    background:#dcfce7;
    color:#166534;
}
.checkout-steps .step.active span{
    background:var(--brand);
    color:#fff;
}

/* ---------- CARD ---------- */
.checkout-card{
    background:#fff;
    border-radius:18px;
    padding:18px;
    box-shadow:0 12px 30px rgba(0,0,0,.06);
}

/* ---------- PRODUCT ---------- */
.checkout-item{
    display:flex;
    gap:14px;
    padding:14px;
    border-radius:14px;
    background:#fff;
    box-shadow:0 8px 20px rgba(0,0,0,.05);
}
.checkout-img{
    width:70px;height:70px;
    border-radius:14px;
    object-fit:cover;
}
.price-card{position:sticky;top:90px;}
</style>

<form method="POST" action="{{ route('place.order') }}" id="checkoutForm">
@csrf
<input type="hidden" name="address_type" id="address_type" value="self">

<div class="container py-4">

    {{-- STEP TRACKER --}}
    <div class="checkout-steps">
        <div class="step active"><span>1</span>Customer</div>
        <div class="step"><span>2</span>Payment</div>
        <div class="step"><span>3</span>Summary</div>
    </div>

    <div class="row g-4">

        {{-- LEFT --}}
        <div class="col-lg-8">

            {{-- STEP 1 --}}
            <div id="step-1" class="checkout-step checkout-card mb-4">
                <h6 class="fw-bold mb-3">Shipping Details</h6>

                <div class="d-flex gap-3 mb-3">
                    <label><input type="radio" name="order_for" value="self" checked> For You</label>
                    <!-- <label><input type="radio" name="order_for" value="other"> Other</label> -->
                </div>

                <div id="form-error" class="alert alert-danger d-none"></div>

                <div class="row g-3">
                    <div class="col-md-6"><input id="name" name="name" class="form-control" placeholder="Full Name"></div>
                    <div class="col-md-6"><input id="phone" name="phone" class="form-control" placeholder="Phone"></div>
                    <div class="col-12"><input id="email" name="email" class="form-control" placeholder="Email"></div>
                    <div class="col-12"><textarea id="address" name="address" class="form-control" placeholder="Address"></textarea></div>
                    <div class="col-md-6"><input id="state" name="state" class="form-control" placeholder="State"></div>
                    <div class="col-md-6"><input id="pincode" type="number" name="pincode" class="form-control" placeholder="Pincode"></div>
                    <div class="col-12"><input id="near_place" name="near_place" class="form-control" placeholder="Landmark"></div>
                </div>

                <button type="button" id="to-payment" class="btn btn-success mt-4 w-100">
                    Continue to Payment →
                </button>
            </div>

            {{-- STEP 2 --}}
            <div id="step-2" class="checkout-step checkout-card mb-4 d-none">
                <h6 class="fw-bold mb-3">Payment Method</h6>

                <label class="d-flex gap-2 mb-3">
                    <input type="radio" name="payment_method" value="cod" checked>
                    <strong>Cash on Delivery</strong>
                </label>

                <!-- <label class="d-flex gap-2">
                    <input type="radio" name="payment_method" value="upi">
                    <strong>UPI / Online Payment</strong>
                </label> -->

                <div class="d-flex gap-3 mt-4">
                    <button type="button" class="btn btn-outline-secondary w-50" onclick="goToStep(1)">← Back</button>
                    <button type="button" id="to-summary" class="btn btn-success w-50">Continue →</button>
                </div>
            </div>

            {{-- STEP 3 --}}
            <div id="step-3" class="checkout-step d-none">
                <h6 class="fw-bold mb-2">Order Summary</h6>

                @foreach($cart->items as $item)
                <div class="checkout-item mb-3">
                    <img src="{{ asset('storage/'.$item->product->image) }}" class="checkout-img">
                    <div class="flex-grow-1">
                        <strong>{{ $item->product->name }}</strong>
                        <div class="text-muted">₹{{ $item->price }} × {{ $item->qty }}</div>
                    </div>
                    <strong>₹{{ $item->price * $item->qty }}</strong>
                </div>
                @endforeach
            </div>
        </div>

        {{-- RIGHT --}}
        <div class="col-lg-4">
            <div class="checkout-card price-card">
                <h6 class="fw-bold mb-3">Price Details</h6>

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

                <!-- <button id="placeOrderBtn" class="btn btn-success w-100 fw-bold py-3 mt-3 d-none">
                    PLACE ORDER
                </button> -->
                <button type="submit" id="placeOrderBtn"
                    class="btn btn-success w-100 fw-bold py-3 mt-3 d-none">
                    PLACE ORDER
                </button>

            </div>
        </div>

    </div>
</div>
</form>
@push('scripts')
<script>
/* ===============================
   GLOBAL STEP FUNCTION
=============================== */
function goToStep(step) {
    $('.checkout-step').addClass('d-none');
    $('#step-' + step).removeClass('d-none');

    $('.checkout-steps .step').removeClass('active');
    $('.checkout-steps .step:nth-child(' + step + ')')
        .addClass('active');

    $('#placeOrderBtn').toggleClass('d-none', step !== 3);

    window.scrollTo({ top: 0, behavior: 'smooth' });
}

$(document).ready(function () {

    /* ===============================
       SAFETY CHECK
    =============================== */
    if (typeof $.validator === 'undefined') {
        console.error(' jQuery Validation NOT loaded');
        return;
    }
    $.validator.addMethod(
    "strictEmail",
    function (value, element) {
        return this.optional(element) ||
        /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(value);
    },
    "Please enter a valid email address"
);


    /* ===============================
       USER AUTO-FILL
    =============================== */
    const userData = {
        name: "{{ auth()->user()->name }}",
        phone: "{{ auth()->user()->phone ?? '' }}",
        email: "{{ auth()->user()->email }}",
        address: "{{ auth()->user()->address ?? '' }}",
        state: "{{ auth()->user()->state ?? '' }}",
        pincode: "{{ auth()->user()->pincode ?? '' }}",
        near_place: "{{ auth()->user()->near_place ?? '' }}"
    };

    function fillUserAddress() {
        $('#name').val(userData.name);
        $('#phone').val(userData.phone);
        $('#email').val(userData.email);
        $('#address').val(userData.address);
        $('#state').val(userData.state);
        $('#pincode').val(userData.pincode);
        $('#near_place').val(userData.near_place);
    }

    fillUserAddress();

    /* ===============================
       VALIDATION INIT
       IMPORTANT: ignore hidden steps
    =============================== */
    const validator = $('#checkoutForm').validate({
        ignore: ':hidden',
        rules: {
            name: { required: true, minlength: 3 },
            phone: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 10
            },
     email: {
            required: true,
            strictEmail: true
        },

            address: { required: true, minlength: 10 },
            state: { required: true },
            pincode: {
                required: true,
                digits: true,
                minlength: 6,
                maxlength: 6
            }
        },
        messages: {
            name: "Enter full name",
            phone: "Enter valid 10-digit phone number",
             strictEmail: "Enter a valid email address",
            address: "Enter complete address (min 10 chars)",
            state: "State is required",
            pincode: "Enter valid 6-digit pincode"
        },
        errorElement: "small",
        errorClass: "text-danger",
        highlight(el) {
            $(el).addClass("is-invalid");
        },
        unhighlight(el) {
            $(el).removeClass("is-invalid");
        }
    });

    /* ===============================
       STEP BUTTONS
    =============================== */
    $('#to-payment').on('click', function () {
        if ($('#checkoutForm').valid()) {
            goToStep(2);
        }
    });

    $('#to-summary').on('click', function () {
        goToStep(3);
    });

    /* ===============================
       FINAL SUBMIT
    =============================== */
    $('#checkoutForm').on('submit', function (e) {
        if (!$(this).valid()) {
            e.preventDefault();
            return false;
        }
    });

});
</script>
@endpush

</x-app-layout>
