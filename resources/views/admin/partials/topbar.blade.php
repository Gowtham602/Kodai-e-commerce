<header class="admin-topbar">
    <button class="hamburger-btn" id="sidebarToggle">
        <i class="bi bi-list"></i>
    </button>

    <div class="topbar-right">
        <div class="admin-user">
            <span class="user-name">{{ auth()->user()->name }}</span>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="logout-btn">
                    <i class="bi bi-box-arrow-right"></i>
                </button>
            </form>
        </div>
    </div>
</header>
