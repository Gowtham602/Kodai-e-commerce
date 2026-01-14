<style>
    .custom-offcanvas {
    padding: 16px;
}

/* Menu items */
.menu-item {
    display: flex;
    align-items: center;
    padding: 14px 16px;
    border-radius: 14px;
    margin-bottom: 10px;
    background: #f8f9fa;
    color: #1f2937;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s ease;
}

.menu-item i {
    font-size: 16px;
}

.menu-item:hover,
.menu-item.active {
    background: #fff7cc;   /* soft honey background */
    color: #7c2d12;        /* dark honey text */
}


/* Divider */
.menu-divider {
    margin: 16px 0;
}

/* User box */
.user-box {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px;
    border-radius: 16px;
    background: #f1f5f9;
    margin-bottom: 10px;
}

.avatar {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: #f59e0b;
    color: #fff;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Admin */
.admin-link {
    background: #fff3cd;
    color: #856404;
}

.admin-link:hover {
    background: #856404;
    color: #fff;
}

/* Auth spacing */
.auth-buttons {
    margin-top: 20px;
}

</style>

<div class="offcanvas offcanvas-start d-md-none" id="mobileMenu" tabindex="-1">
    
    <!-- HEADER -->
    <div class="offcanvas-header border-bottom">
        <h5 class="fw-bold text-warning mb-0">
            <i class="fas fa-leaf me-2"></i> Kodai Choco
        </h5>
        <button class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>

    <!-- BODY (IMPORTANT) -->
    <div class="offcanvas-body custom-offcanvas">

        <!-- MENU LINKS -->
        <nav class="menu-links">
            <a href="{{ route('products.index') }}" class="menu-item">
                <i class="fas fa-box me-3"></i> Products
            </a>
            <a href="{{ route('about') }}" class="menu-item active">
                <i class="fas fa-info-circle me-3"></i> About
            </a>
            <!-- <a href="#" class="menu-item">
                <i class="fas fa-phone me-3"></i> Contact
            </a> -->
             <a href="{{ route('orders.index') }}" class="menu-item">Your Orders </a>
        </nav>

        <hr class="menu-divider">

        @auth
            <!-- USER CARD -->
            <div class="user-box">
                <div class="avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <div class="fw-semibold">Hi, {{ Auth::user()->name }}</div>
                    <small class="text-muted">Welcome back 👋</small>
                </div>
            </div>

            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="menu-item admin-link mt-2">
                    <i class="fas fa-user-shield me-3"></i> Admin Panel
                </a>
            @endif

            <form method="POST" action="{{ route('logout') }}" class="mt-3">
                @csrf
                <button class="btn btn-danger w-100 rounded-pill">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </button>
            </form>
        @else
            <!-- AUTH BUTTONS -->
            <div class="auth-buttons">
                <button class="btn btn-warning w-100 rounded-pill mb-2"
                        data-bs-dismiss="offcanvas"
                        data-bs-toggle="modal"
                        data-bs-target="#loginModal">
                    <i class="fas fa-sign-in-alt me-2"></i> Login
                </button>

                <button class="btn btn-outline-warning w-100 rounded-pill"
                        data-bs-dismiss="offcanvas"
                        data-bs-toggle="modal"
                        data-bs-target="#registerModal">
                    <i class="fas fa-user-plus me-2"></i> Register
                </button>
            </div>
        @endauth

    </div>
</div>
