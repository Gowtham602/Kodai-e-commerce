<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>

    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="appToast" class="toast align-items-center text-white border-0">
            <div class="d-flex">
                <div class="toast-body"></div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto"
                        data-bs-dismiss="toast"></button>
            </div>
        </div>
    </div>

</div>
<script>
    function toggleSidebar() {
        document.querySelector('.admin-sidebar').classList.toggle('show');
    }
</script>
<script>
function showToast(message, type = 'success') {
    const toastEl = document.getElementById('appToast');
    toastEl.className = `toast align-items-center text-white bg-${type} border-0`;

    toastEl.querySelector('.toast-body').innerText = message;

    const toast = new bootstrap.Toast(toastEl);
    toast.show();
}
</script>
<!-- Vite JS -->
@vite(['resources/js/app.js'])
@stack('scripts')


</body>
</html>
