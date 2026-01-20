<!-- MOBILE TOP HEADER -->
<header class="mobile-top-bar  d-md-none">
    <div class="container d-flex align-items-center justify-content-between">

        <!-- Logo -->
        <a href="{{ route('home') }}" class="logo d-flex align-items-center">
                <img src="{{ asset('assets/logo/kodai_choco_dark_brown1.svg') }}" alt="Kodai Choco" style="height: 43px; width:auto;" class="me-0">
                
        </a>

        <!-- Right icons -->
        <div class="mobile-top-actions">

            <!-- Cart -->
            <a href="{{ route('cart.index') }}" class="icon-btn position-relative">
                <i class="bi bi-cart"></i>
                <span class="cart-badge" id="cart-count-mobile">
                    {{ session('cart') ? count(session('cart')) : 0 }}
                </span>
            </a>

            <!-- Hamburger -->
            <button class="icon-btn"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#mobileMenu">
                <i class="bi bi-list"></i>
            </button>

        </div>
    </div>
</header>
