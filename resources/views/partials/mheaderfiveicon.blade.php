<!-- MOBILE BOTTOM NAV -->
<nav class="mobile-bottom-nav d-md-none">

    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
        <i class="bi bi-house"></i>
        <span>Home</span>
    </a>

    <a href="{{ route('products.index') }}"
       class="{{ request()->routeIs('products.*') ? 'active' : '' }}">
        <i class="bi bi-grid"></i>
        <span>Categories</span>
    </a>

    <!-- <a href="#" class="">
        <i class="bi bi-heart"></i>
        <span>Favorites</span>
    </a> -->

    @auth
        <a href="{{ route('profile.edit') }}">
            <i class="bi bi-person"></i>
            <span>Profile</span>
        </a>
    @else
        <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal">
            <i class="bi bi-person"></i>
            <span>Login</span>
        </a>
    @endauth

    <a href="{{ route('cart.index') }}">
        <i class="bi bi-cart"></i>
        <span>Cart</span>
    </a>

</nav>



