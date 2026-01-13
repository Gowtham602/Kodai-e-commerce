<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kodai Choco
    </title>
    {{-- <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}"> --}}
    <link rel="icon" href="/favicon.ico">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        window.appConfig = {
            routes: {
                filterProducts: "{{ route('products.filter') }}",
                addToCart: "{{ route('cart.add') }}",
                updateCart: "{{ route('cart.update') }}",
                deleteCart: "{{ route('cart.delete') }}",
                products: "{{ route('products.index') }}"
            },
            csrf: "{{ csrf_token() }}"
        };
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!--  jQuery FIRST -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>
{{-- <body class="pt-[72px]"> offset for fixed navbar --}}

<body class="d-flex flex-column min-vh-100">

    {{-- HEADER --}}
    @include('partials.header')
    {{-- moblie --}}
    @include('partials.mobileheader')
    @include('partials.sticky')
    <div id="stickyCartBar" class="sticky-cart py-5 d-none">
        <div class="container d-flex align-items-center justify-content-between">
            <div>
                <strong>View cart</strong><br>
                <small>
                    <span id="stickyCartCount">0</span> items
                </small>
            </div>

            <a href="{{ route('cart.index') }}" class="btn btn-light btn-sm fw-bold">
                Open
            </a>
        </div>
    </div>


    @if(!request()->routeIs('home'))
    <div class="navbar-offset"></div>
    @endif

    {{-- PAGE CONTENT --}}
    <main class="flex-fill">
        {{ $slot }}
    </main>

    {{-- FOOTER --}}
    @include('partials.footer')
    {{-- AUTH MODALS --}}
    @include('auth.login-modal')
    @include('auth.register-modal')

    {{-- SUCCESS TOAST --}}
    @if(session('success'))
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index:9999;">
        <div id="successToast" class="toast text-bg-warning border-0">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('success') }}
                </div>
                <button type="button"
                    class="btn-close btn-close-white me-2 m-auto"
                    data-bs-dismiss="toast"></button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof bootstrap !== 'undefined') {
                new bootstrap.Toast(
                    document.getElementById('successToast'), {
                        delay: 3000
                    }
                ).show();
            }
        });
    </script>
    @endif

    {{-- AUTO OPEN REGISTER MODAL ON ERROR --}}
    @if ($errors->getBag('register')->any())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
    @if(session('showLoginModal'))
    <script>
        window.addEventListener('load', function() {
            if (typeof bootstrap !== 'undefined') {
                console.log('bootstrap:', typeof bootstrap);
                console.log('modal:', document.getElementById('loginModal'));

                const modalEl = document.getElementById('loginModal');
                if (modalEl) {
                    console.log("login model")
                    new bootstrap.Modal(modalEl, {
                        backdrop: 'static',
                        keyboard: false
                    }).show();
                }
            }
        });
    </script>
    @endif


    {{-- AUTO OPEN LOGIN MODAL ON ERROR --}}
    @if ($errors->getBag('login')->any())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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



<div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1100;">
    <div id="cartToast"
        class="toast cart-toast border-0"
        role="alert"
        aria-live="assertive"
        aria-atomic="true">

        <div class="d-flex align-items-center px-3 py-2">
            <div class="toast-icon me-2">🛒</div>

            <div class="toast-body p-0" id="toastText">
                Added to cart successfully
            </div>

            <button type="button"
                class="btn-close ms-auto"
                data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>
@if (session('status'))
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="resetToast"
        class="toast align-items-center text-bg-warning border-0 show"
        role="alert">
        <div class="d-flex">
            <div class="toast-body">
                {{ session('status') }}
            </div>
            <button type="button"
                class="btn-close btn-close-white me-2 m-auto"
                data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>

<script>
    setTimeout(() => {
        const toastEl = document.getElementById('resetToast');
        if (toastEl) bootstrap.Toast.getOrCreateInstance(toastEl).hide();
    }, 4000);
</script>
@endif
@if (session('password_reset'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const loginModalEl = document.getElementById('loginModal');
        if (loginModalEl) {
            new bootstrap.Modal(loginModalEl).show();
        }
    });
</script>
@endif


{{-- //toster for login and register --}}


<!-- mobile offcanvan   -->
@include('partials.offcanvaheader')

@include('partials.mheaderfiveicon')


</body>

</html>