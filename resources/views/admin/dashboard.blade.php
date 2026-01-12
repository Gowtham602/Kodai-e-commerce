<x-admin-layout>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

    <style>
        /* RESET LINK CARDS */
        .stats-grid a {
            text-decoration: none;
            color: inherit;
            display: block;
        }

        /* GRID */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        /* CARD */
        .stat-card {
            background: #fff;
            padding: 18px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            transition: transform 0.25s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
        }

        .stat-card h6 {
            margin: 0;
            font-size: 14px;
            color: #6b7280;
        }

        .stat-card h2 {
            margin-top: 6px;
            font-size: 24px;
            font-weight: 800;
        }

        /* COLORS */
        .stat-card.green {
            border-left: 6px solid #22c55e;
        }

        .stat-card.yellow {
            border-left: 6px solid #facc15;
        }

        .stat-card.blue {
            border-left: 6px solid #3b82f6;
        }

        .stat-card.purple {
            border-left: 6px solid #8b5cf6;
        }

        /* MOBILE FIX */
        @media (max-width: 480px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .stat-card {
                padding: 16px;
            }

            .stat-card h2 {
                font-size: 22px;
            }
        }
    </style>

    <h2 class="mb-4">Admin Dashboard</h2>
    <div class="stats-grid">



        <a href="{{ route('admin.orders.index') }}">
            <div class="stat-card green">
                <h6>Orders</h6>
                <h2>{{ $ordersCount }}</h2>
            </div>

        </a>


        <div class="stat-card yellow">
            <h6>Today Orders</h6>
            <h2>{{ $todayOrders }}</h2>
        </div>


        <a href="{{ route('admin.products.index') }}">
            <div class="stat-card blue">
                <h6>Products</h6>
                <h2>{{ $productsCount }}</h2>
            </div>
        </a>

       
          <a href="{{ route('admin.users.index') }}">
            <div class="stat-card purple">
            <h6>Users</h6>
            <h2>{{ $usersCount }}</h2>
        </div>
        </a>

    </div>

    <!-- <div class="row g-4">

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5>Manage Products</h5>
                    <a href="{{ route('admin.products.index') }}"
                       class="btn btn-success btn-sm">
                        Open Products
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5>Today Deals</h5>
                    <a href="{{ route('admin.today-deals.create') }}"
                       class="btn btn-warning btn-sm text-white">
                        Manage Deals
                    </a>
                </div>
            </div>
        </div>

    </div> -->

</x-admin-layout>