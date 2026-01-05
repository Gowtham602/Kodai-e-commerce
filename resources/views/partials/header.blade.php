<!-- Navbar HTML -->
<div class="d-none d-md-block">
    <nav class="smn navbar">


        <div class="container">

            <!-- Logo -->
            <a href="{{ route('home') }}" class="logo">
                <i class="fas fa-mountain"></i> Kodai Chocolates
            </a>

            <!-- Mobile toggle -->
            <button class="mobile-toggle" id="mobile-menu-button">
                &#9776;
            </button>

            <!-- Links -->
            <div class="nav-links" id="navbar-menu">

                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                <a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.index') ? 'active' : '' }}">Products</a>
                <a href="{{ route('about') }}">About</a>
                <a href="{{ route('home') }}">Contact </a>

                {{-- Admin link --}}
                @auth
                @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}">Admin Panel</a>
                @endif
                @endauth

                {{-- Guest --}}
                @guest
                <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
                <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal">Register</a>
                @endguest

                {{-- Logged-in user --}}
                @auth
                <div class="dropdown">
                    <button class="dropbtn">
                        {{ Auth::user()->name }} &#x25BC;
                    </button>

                    <div class="dropdown-content">
                        <a href="{{ route('profile.edit') }}" class="text-black p-3">Profile</a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="logout-btn">Logout</button>
                        </form>
                    </div>
                </div>
                @endauth

                {{-- Cart (always visible) --}}
                <a href="{{ route('cart.index') }}" class="cart">
                    <i class="fas fa-shopping-cart"></i>
                    <span id="cart-count">Order</span>
                </a>

            </div>
        </div>
        {{-- //mobile --}}
    </nav>
    </div>