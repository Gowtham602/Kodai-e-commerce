<aside class="admin-sidebar">

    <div class="admin-brand">
        <div class="brand-icon">▲</div>
        <div class="brand-text">Kodai Admin</div>
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

    </nav>

</aside>
