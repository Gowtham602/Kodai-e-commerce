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

<script>

    //three step 3 validation
function goToStep(step){
    $('.checkout-step').addClass('d-none');
    $('#step-'+step).removeClass('d-none');

    $('.checkout-steps .step').removeClass('active');
    $('.checkout-steps .step:nth-child('+step+')').addClass('active');

    if(step === 3){
        $('#placeOrderBtn').removeClass('d-none');
    } else {
        $('#placeOrderBtn').addClass('d-none');
    }

    window.scrollTo({top:0,behavior:'smooth'});
}

$('#to-payment').click(function () {

    let error = '';

    if (!$('#name').val().trim()) {
        error = 'Name is required';
        $('#name').focus();
    }
    else if (!/^[0-9]{10}$/.test($('#phone').val())) {
        error = 'Phone must be 10 digits';
        $('#phone').focus();
    }
    else if (!$('#address').val().trim()) {
        error = 'Address is required';
        $('#address').focus();
    }
    else if (!$('#state').val().trim()) {
        error = 'State is required';
        $('#state').focus();
    }
    else if (!/^[0-9]{6}$/.test($('#pincode').val())) {
        error = 'Pincode must be 6 digits';
        $('#pincode').focus();
    }

    if (error) {
        $('#form-error').removeClass('d-none').text(error);

        $('html, body').animate({
            scrollTop: $('#form-error').offset().top - 80
        }, 300);

        return;
    }

    $('#form-error').addClass('d-none');
    goToStep(2);
});


$('#to-summary').click(function(){
    goToStep(3);
});

//user details
$(document).ready(function () {

    const userData = {
        name: "{{ auth()->user()->name }}",
        phone: "{{ auth()->user()->phone ?? '' }}",
        email: "{{ auth()->user()->email }}",
        address: "{{ auth()->user()->address ?? '' }}",
        state: "{{ auth()->user()->state ?? '' }}",
        pincode: "{{ auth()->user()->pincode ?? '' }}",
        near_place: "{{ auth()->user()->near_place ?? '' }}"
    };

    function fillUser() {
        $('#name').val(userData.name);
        $('#phone').val(userData.phone);
        $('#email').val(userData.email);
        $('#address').val(userData.address);
        $('#state').val(userData.state);
        $('#pincode').val(userData.pincode);
        $('#near_place').val(userData.near_place);
    }

    function clearForm() {
        $('#address-form input, #address-form textarea').val('');
    }

    fillUser();

    // RADIO CHANGE
    $('input[name="order_for"]').change(function () {
        $('input[name="address_id"]').prop('checked', false);

        if (this.value === 'self') {
            $('#address_type').val('self');
            fillUser();
        } else {
            $('#address_type').val('other');
            clearForm();
        }
    });

    // SAVED ADDRESS
    $('input[name="address_id"]').change(function () {
        clearForm();
        $('#address_type').val('saved');
    });

    //  JQUERY VALIDATION (NO RELOAD)
    
    console.log('Checkout validation JS loaded');

    $('#checkoutForm').on('submit', function (e) {

        e.preventDefault(); //  ALWAYS STOP FIRST

        let addressType = $('#address_type').val();
        let error = '';

        console.log('Address type:', addressType);

        // CASE: Saved address
        if (addressType === 'saved') {
            if ($('input[name="address_id"]:checked').length === 0) {
                error = 'Please select a saved address';
            }
            if ($('input[name="state"]:checked').length === 0) {
                error = 'Address is required';
            }
             if ($('input[name="pincode"]:checked').length === 0) {
                error = 'Pincode  is required';
            }
        }
        // CASE: Manual address
        else {
            if (!$('#name').val().trim()) error = 'Name is required';
            else if (!$('#phone').val().trim()) error = 'Phone is required';
            else if ($('#phone').val().length < 10) error = 'Phone must be 10 digits';
            else if (!$('#address').val().trim()) error = 'Address is required';
            else if (!$('#state').val().trim()) error = 'State is required';
            else if (!$('#pincode').val().trim()) error = 'Pincode is required';
        }

        // if (error !== '') {
        //     $('#form-error')
        //         .removeClass('d-none')
        //         .text(error);

        //     $('html, body').animate({
        //         scrollTop: $('#form-error').offset().top - 100
        //     }, 300);

        //     console.warn('Validation failed:', error);
        //     return false;
        // }
if (error !== '') {

    $('#form-error')
        .removeClass('d-none')
        .text(error);

    $('.form-control').removeClass('is-invalid');

    if (error.includes('State')) {
        $('#state').addClass('is-invalid').focus();
    } else if (error.includes('Address')) {
        $('#address').addClass('is-invalid').focus();
    } else if (error.includes('Phone')) {
        $('#phone').addClass('is-invalid').focus();
    }

    $('html, body').animate({
        scrollTop: $('#form-error').offset().top - 80
    }, 300);

    return;
}

        console.log('Validation passed → submitting form');

        //  ONLY NOW submit
        // this.submit();
        e.currentTarget.submit();

    });

});
</script>
</x-app-layout>
