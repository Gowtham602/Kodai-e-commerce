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



<form method="POST" action="{{ route('place.order') }}">
@csrf

<div class="container py-4">

    <h4 class="fw-bold mb-3">Checkout</h4>
    <h6 class="fw-bold mb-3">Who is this order for?</h6>

<div class="d-flex gap-3 mb-3">
    <label>
        <input type="radio" name="order_for" value="self" checked>
        For You
    </label>

    <label>
        <input type="radio" name="order_for" value="other">
        Other
    </label>
</div>
<div id="address-form" class="card border-0 shadow-sm rounded-4">
    <div class="card-body">

        <div id="form-error" class="alert alert-danger d-none"></div>

        <input name="name" id="name" class="form-control mb-2" placeholder="Full Name">
        <input name="phone" id="phone" class="form-control mb-2" placeholder="Phone">
        <input name="email" id="email" class="form-control mb-2" placeholder="Email">
        <textarea name="address" id="address" class="form-control mb-2" placeholder="Address"></textarea>
        <input name="state" id="state" class="form-control mb-2" placeholder="State">
        <input name="pincode" id="pincode" class="form-control mb-2" placeholder="Pincode">
        <input name="near_place" id="near_place" class="form-control" placeholder="Near place">

    </div>
</div>



    {{-- PRICE CHANGE --}}
    @if($priceChanged)
        <div class="alert alert-warning rounded-3">
            Some product prices have changed. We updated your cart.
        </div>
    @endif

    {{-- ERROR --}}
    @if($errors->any())
        <div class="alert alert-danger rounded-3">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="row g-4">
        <!-- <input type="hidden" name="address_type" id="address_type" value="self"> -->

        <!-- <input type="hidden" name="address_type" value="self"> -->
        <input type="hidden" name="address_type" id="address_type" value="self">




        {{-- LEFT --}}
        <div class="col-lg-8">

            {{-- SAVED ADDRESS --}}
            @if($addresses->count())
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3">Select Delivery Address</h6>

                        @foreach($addresses as $addr)
                            <label class="border rounded-3 p-3 mb-2 w-100 d-block">
                                <input type="radio"
                                       name="address_id"
                                       value="{{ $addr->id }}"
                                       class="me-2">

                                <strong>{{ $addr->name }}</strong><br>
                                {{ $addr->phone }}<br>
                                {{ $addr->address }},
                                {{ $addr->state }} - {{ $addr->pincode }}<br>
                                <small class="text-muted">{{ $addr->near_place }}</small>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endif

          

            {{-- PRODUCTS --}}
            @foreach($cart->items as $item)
                <div class="checkout-item mb-3">
                    <div class="d-flex gap-3 align-items-center">
                        <img src="{{ asset('storage/'.$item->product->image) }}" class="checkout-img">
                        <div class="flex-grow-1">
                            <div class="checkout-title">{{ $item->product->name }}</div>
                            <div class="checkout-price">
                                ₹{{ $item->price }} × {{ $item->qty }}
                            </div>
                        </div>
                        <div class="checkout-total">
                            ₹{{ $item->price * $item->qty }}
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        {{-- RIGHT --}}
        <div class="col-lg-4">
            <div class="card border-0 price-card sticky-top" style="top:90px">
                <div class="card-body">

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

                    <button class="btn btn-success w-100 fw-bold py-3 mt-4">
                        CONFIRM & PLACE ORDER
                    </button>

                </div>
            </div>
        </div>

    </div>
</div>

{{-- MOBILE BAR --}}
<div class="mobile-checkout d-lg-none">
    <div class="d-flex justify-content-between mb-2">
        <strong>Total</strong>
        <strong>₹{{ $cart->subtotal }}</strong>
    </div>
    <button class="btn btn-success w-100 fw-bold">
        CONFIRM ORDER
    </button>
</div>

</form>

<script>
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

    $('form').on('submit', function (e) {

        e.preventDefault(); //  ALWAYS STOP FIRST

        let addressType = $('#address_type').val();
        let error = '';

        console.log('Address type:', addressType);

        // CASE: Saved address
        if (addressType === 'saved') {
            if ($('input[name="address_id"]:checked').length === 0) {
                error = 'Please select a saved address';
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

        if (error !== '') {
            $('#form-error')
                .removeClass('d-none')
                .text(error);

            $('html, body').animate({
                scrollTop: $('#form-error').offset().top - 100
            }, 300);

            console.warn('Validation failed:', error);
            return false;
        }

        console.log('Validation passed → submitting form');

        //  ONLY NOW submit
        this.submit();
    });

});
</script>




</x-app-layout>
