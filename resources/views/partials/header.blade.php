<!-- Navbar HTML -->
<nav class="navbar">
    <div class="container">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="logo">
            <i class="fas fa-mountain"></i> Kodai Specials
        </a>

        <!-- Mobile toggle button -->
        <button class="mobile-toggle" id="mobile-menu-button">
            &#9776;
        </button>

        <!-- Navbar links -->
        <div class="nav-links" id="navbar-menu">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            <a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.index') ? 'active' : '' }}">Products</a>
            <a href="{{ route('about') }}#about">About</a>
            <a href="{{ route('home') }}#contact">Contact</a>

            @guest
            <a href="{{ route('login') }}" class="btn login">Login</a>
            <a href="{{ route('register') }}" class="btn register">Register</a>
            @else
            <!-- User Dropdown -->
            <div class="dropdown">
                <button class="dropbtn">{{ Auth::user()->name }} &#x25BC;</button>
                <div class="dropdown-content">
                    <a href="{{ route('profile.edit') }}">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="logout-btn">Logout</button>
                    </form>
                </div>
            </div>
            @endguest

            <!-- Cart Icon -->
          <a href="{{ route('cart.index') }}" class="cart">
            <i class="fas fa-shopping-cart"></i>
            <span id="cart-count">0</span>
        </a>

        </div>
    </div>
</nav>




