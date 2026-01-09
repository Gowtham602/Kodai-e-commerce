<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>

    @vite(['resources/css/app.css','resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>

<div class="admin-wrapper">

    {{-- SIDEBAR --}}
    @include('admin.partials.sidebar')

    {{-- RIGHT SIDE --}}
    <div class="admin-main">

        {{-- TOP BAR --}}
        @include('admin.partials.navbar')

        {{-- PAGE CONTENT --}}
        <div class="admin-content">
            {{ $slot }}
        </div>

    </div>

</div>

<script>
    function toggleSidebar() {
        document.querySelector('.admin-sidebar').classList.toggle('show');
    }
</script>

</body>
</html>
