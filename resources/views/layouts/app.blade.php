<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kodai Choco</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    window.appConfig = {
        routes: {
            filterProducts: "{{ route('products.filter') }}",
            addToCart: "{{ route('cart.add') }}"
        },
        csrf: "{{ csrf_token() }}"
    };
</script>

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
  


</body>

</html>
