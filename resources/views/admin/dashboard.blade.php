<x-app-layout>
    <div class="container my-5">

        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="p-4 rounded text-white shadow"
                     style="background: linear-gradient(135deg, #198754, #20c997);">
                    <h2 class="mb-1">Admin Dashboard</h2>
                    <p class="mb-0 opacity-75">
                        Welcome back, {{ auth()->user()->name }} 👋
                    </p>
                </div>
            </div>
        </div>

        <!-- Dashboard Cards -->
        <div class="row g-4">

            <!-- Products -->
            <div class="col-md-6">
                <div class="card border-0 shadow-sm dashboard-card">
                    <div class="card-body d-flex align-items-center">
                        <div class="icon-box bg-success text-white me-3">
                            <i class="bi bi-box-seam"></i>
                        </div>
                        <div>
                            <h5 class="mb-1">Manage Products</h5>
                            <p class="text-muted small mb-2">
                                Add, edit and control products
                            </p>
                            <a href="{{ route('admin.products.index') }}"
                               class="btn btn-success btn-sm">
                                Open Products
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Today Deals -->
            <div class="col-md-6">
                <div class="card border-0 shadow-sm dashboard-card">
                    <div class="card-body d-flex align-items-center">
                        <div class="icon-box bg-warning text-white me-3">
                            <i class="bi bi-lightning-charge"></i>
                        </div>
                        <div>
                            <h5 class="mb-1">Today Deals</h5>
                            <p class="text-muted small mb-2">
                                Highlight daily special offers
                            </p>
                            <a href="{{ route('admin.today-deals.create') }}"
                               class="btn btn-warning btn-sm text-white">
                                Manage Deals
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Custom CSS -->
    <style>
        .dashboard-card {
            transition: all 0.3s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0,0,0,0.08);
        }

        .icon-box {
            width: 55px;
            height: 55px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }
    </style>
</x-app-layout>
