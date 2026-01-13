<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kodai Choco</title>

    <link rel="icon" href="/favicon.ico">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        window.appConfig = {
            routes: {
                filterProducts: "{{ route('products.filter') }}",
                addToCart: "{{ route('cart.add') }}",
                updateCart: "{{ route('cart.update') }}",
                deleteCart: "{{ route('cart.delete') }}",
                products: "{{ route('products.index') }}",
                  summary: "{{ route('cart.summary') }}"
            },
            csrf: "{{ csrf_token() }}"
        };
    </script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
   
</head>

<body class="d-flex flex-column min-vh-100">

{{-- HEADER --}}
@include('partials.header')
@include('partials.mobileheader')



@if(!request()->routeIs('home'))
    <div class="navbar-offset"></div>
@endif

{{-- PAGE CONTENT --}}
<main class="flex-fill">
    {{ $slot }}
</main>

{{-- FOOTER --}}
@include('partials.footer')


{{-- STICKY CART BAR --}}
@php
    $hideSticky = request()->routeIs(
        'cart.index',
        'checkout.index',
        'order.success'
    );
@endphp

@if (!$hideSticky)
<div id="stickyCartBar" class="sticky-cart d-none">
    <div class="sticky-cart-inner">
        <div class="sticky-cart-left">
            <span class="cart-title">View cart</span>
            <span class="cart-meta">
                <span id="stickyCartCount">0</span> item(s) · ₹<span id="stickySubtotal">0</span>
            </span>
        </div>

        <a href="{{ route('cart.index') }}" class="sticky-cart-btn">
            Open →
        </a>
    </div>
</div>
@endif


{{-- AUTH MODALS --}}
@include('auth.login-modal')
@include('auth.register-modal')
@stack('scripts')


{{-- =========================
   SUCCESS TOAST
========================= --}}
@if(session('success'))
<div class="toast-container position-fixed top-0 end-0 p-3" style="z-index:9999;">
    <div id="successToast" class="toast text-bg-warning border-0">
        <div class="d-flex">
            <div class="toast-body">
                {{ session('success') }}
            </div>
            <button class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    if (typeof bootstrap !== 'undefined') {
        new bootstrap.Toast(
            document.getElementById('successToast'),
            { delay: 3000 }
        ).show();
    }
});
</script>
@endif

{{-- =========================
   CART TOAST
========================= --}}
<div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index:1100;">
    <div id="cartToast" class="toast cart-toast border-0">
        <div class="d-flex align-items-center px-3 py-2">
            <div class="toast-icon me-2">🛒</div>
            <div id="cartBubble" class="cart-bubble d-none">+1</div>

            <div class="toast-body p-0" id="toastText">
                Added to cart successfully
            </div>
            <button class="btn-close ms-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>

{{-- =========================
   PASSWORD RESET TOAST
========================= --}}
@if (session('status'))
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="resetToast" class="toast align-items-center text-bg-warning border-0 show">
        <div class="d-flex">
            <div class="toast-body">
                {{ session('status') }}
            </div>
            <button class="btn-close btn-close-white me-2 m-auto"
                    data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    if (typeof bootstrap !== 'undefined') {
        const toastEl = document.getElementById('resetToast');
        bootstrap.Toast.getOrCreateInstance(toastEl, { delay: 4000 }).show();
    }
});
</script>
@endif

{{-- =========================
   AUTO OPEN REGISTER MODAL (ERROR)
========================= --}}
@if ($errors->getBag('register')->any())
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modalEl = document.getElementById('registerModal');
    if (modalEl && typeof bootstrap !== 'undefined') {
        new bootstrap.Modal(modalEl, {
            backdrop: 'static',
            keyboard: false
        }).show();
    }
});
</script>
@endif

{{-- =========================
   AUTO OPEN LOGIN MODAL
   (LOGIN ERROR OR PASSWORD RESET)
========================= --}}
@if (
    $errors->getBag('login')->any() ||
    session('password_reset')
)
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modalEl = document.getElementById('loginModal');
    if (modalEl && typeof bootstrap !== 'undefined') {
        new bootstrap.Modal(modalEl, {
            backdrop: 'static',
            keyboard: false
        }).show();
    }
});
</script>
@endif

{{-- MOBILE COMPONENTS --}}
@include('partials.offcanvaheader')
@include('partials.mheaderfiveicon')

</body>
</html>
