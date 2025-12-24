<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kodai Specials</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    window.appConfig = {
        routes: {
            filterProducts: "{{ route('products.filter') }}",
            addToCart: "{{ route('cart.add') }}",
            updateCart: "{{ route('cart.update') }}",
            deleteCart: "{{ route('cart.delete') }}"
        },
        csrf: "{{ csrf_token() }}"
    };
</script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
{{-- <body class="pt-[72px]"> offset for fixed navbar --}}
<body class="d-flex flex-column min-vh-100">

    {{-- HEADER --}}
    @include('partials.header')

    {{-- OFFSET FOR FIXED HEADER --}}
    <div class="navbar-offset"></div>

    {{-- PAGE CONTENT --}}
    <main class="flex-fill">
        {{ $slot }}
    </main>

    {{-- FOOTER --}}
    @include('partials.footer')
  
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


</body>

</html>
