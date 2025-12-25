<x-app-layout>
    <div class="container my-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="mb-3">Admin Dashboard</h3>

                <p>Welcome, {{ auth()->user()->name }} 👋</p>

                <div class="mt-4">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-success">
                        Manage Products
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
