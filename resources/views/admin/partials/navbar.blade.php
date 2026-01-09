<nav class="admin-navbar">

    <button class="hamburger-btn d-md-none" onclick="toggleSidebar()">
        <i class="bi bi-list"></i>
    </button>

    <div class="admin-user">
        <span class="user-name"><small>Welcome   </small>{{ auth()->user()->name }}</span>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="logout-btn">Logout</button>
        </form>
    </div>

</nav>
