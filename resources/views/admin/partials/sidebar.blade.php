<aside class="admin-sidebar">

    <div class="admin-brand">
    <div class="brand-left">
        <!-- <div class="brand-icon">▲</div> -->
        <div class="brand-text">Kodai Admin</div>

        <!-- Close button -->
        <button class="sidebar-close" aria-label="Close sidebar">
            &times;
        </button>
    </div>
</div>


    <nav class="admin-menu">

        <a href="{{ route('admin.dashboard') }}"
           class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <div class="icon-box"><i class="bi bi-speedometer2"></i></div>
            Dashboard
        </a>

        <a href="{{ route('admin.products.index') }}"
           class="menu-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
            <div class="icon-box"><i class="bi bi-box-seam"></i></div>
            Products
        </a>

        <a href="{{ route('admin.today-deals.create') }}"
           class="menu-item {{ request()->routeIs('admin.today-deals.*') ? 'active' : '' }}">
            <div class="icon-box"><i class="bi bi-lightning-charge"></i></div>
            Deals
        </a>
        <a href="{{ route('admin.orders.index') }}"
            class="menu-item {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <span class="icon-box">
                    <i class="bi bi-receipt"></i>
                </span>
                Orders
            </a>
            <a href="{{ route('admin.categories.index') }}"
                class="menu-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <div class="icon-box"><i class="bi bi-tags"></i></div>
                    Categories
                </a>



    </nav>

</aside>
<script>
    document.querySelector('.sidebar-close')
        ?.addEventListener('click', () => {
            document.querySelector('.admin-sidebar')
                .classList.remove('show');
        });
</script>
