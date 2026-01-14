<x-admin-layout>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <div class="admin-products">

        <!-- HEADER -->
        <div class="admin-header mb-4">
            <div>
                <h3 class="mb-1">Products</h3>
                <p class="mb-0">Manage your store inventory</p>
            </div>

            <a href="{{ route('admin.products.create') }}" class="add-btn">
                <i class="bi bi-plus-lg"></i> Add Product
            </a>
        </div>

        @if(session('success'))
        <div class="alert alert-warning rounded-3">
            {{ session('success') }}
        </div>
        @endif

        <!-- DESKTOP GRID -->
        <div class="row g-4 d-none d-md-flex">
            @foreach($products as $product)
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="product-card">

                    <div class="img-wrap">
                        <img src="{{ asset('storage/'.$product->image) }}">
                    </div>

                    <div class="product-body">
                        <h6>{{ $product->name }}</h6>

                        <span class="category">
                            {{ $product->category->name ?? 'Uncategorized' }}
                        </span>

                        <div class="price">
                            ₹{{ number_format($product->price,2) }}
                        </div>

                        <div class="d-actions">
                            <a href="{{ route('admin.products.edit',$product) }}"
                                class="btn btn-outline-primary btn-sm ">
                                Edit
                            </a>

                            <form method="POST"
                                action="{{ route('admin.products.destroy',$product) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger btn-sm ">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
            @endforeach
        </div>

        <!-- MOBILE LIST -->
        <div class="d-md-none">
            @foreach($products as $product)
            <div class="mobile-card">

                <img src="{{ asset('storage/'.$product->image) }}">

                <div class="mobile-content">
                    <h6>{{ $product->name }}</h6>
                    <small>{{ $product->category->name ?? 'Uncategorized' }}</small>

                    <div class="price">
                        ₹{{ number_format($product->price,2) }}
                    </div>

                    <div class="mobile-actions">
                        <a href="{{ route('admin.products.edit',$product) }}"
                            class="btn btn-outline-primary btn-sm w-100">
                            Edit
                        </a>

                        <form method="POST"
                            action="{{ route('admin.products.destroy',$product) }}"
                            class="w-100">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm w-100">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>

            </div>
            @endforeach
        </div>

        <!-- PAGINATION (works on all devices) -->
        <div class="mt-4 d-flex justify-content-center">
            {!! $products->withQueryString()->links('pagination::bootstrap-5') !!}
        </div>



    </div>

    <style>
        /* HEADER */
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 22px;
            border-radius: 18px;
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: #ffffff;
        }


        /*  MOBILE FIX */
        @media (max-width: 576px) {
            .admin-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 14px;
            }

            .product-card {
                padding: 10px;
            }

            .img-wrap img {
                height: 150px;
            }

            .admin-header h3 {
                font-size: 20px;
            }

            .admin-header p {
                font-size: 13px;
            }

            .add-btn {
                width: 100%;
                justify-content: center;
            }
        }


        .add-btn {
            background: #fff;
            color: #d97706;
            padding: 10px 18px;
            border-radius: 999px;
            font-weight: 600;
            text-decoration: none;
        }

        /* 📱 Mobile Pagination Style */
        @media (max-width: 576px) {

            .pagination {
                display: flex;
                justify-content: center !important;
                gap: 8px;
                flex-wrap: wrap;
            }

            .pagination li {
                flex: 1 1 auto;
                text-align: center;
            }

            /* Page number buttons */
            .pagination .page-link {
                border-radius: 50px !important;
                padding: 8px 14px;
                font-size: 14px;
                font-weight: 600;
                width: auto;
                background: #ffffff;
                border: 1px solid #198754;
                color: #198754;
            }

            /* Active page highlight */
            .pagination .active .page-link {
                background-color: #f59e0b !important;
                /* honey yellow */
                border-color: #f59e0b !important;
                color: #7c2d12 !important;
                /* dark readable text */
            }


            /* Prev / Next full width */
            .pagination .page-item:first-child .page-link,
            .pagination .page-item:last-child .page-link {
                width: 100%;
                border-radius: 8px !important;
                text-align: center;
            }
        }


        /* CARD */
        .product-card {
            background: #fff;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 18px 40px rgba(0, 0, 0, .08);
            transition: .3s;
            height: 100%;
        }

        .product-card:hover {
            transform: translateY(-6px);
        }

        .img-wrap img {
            width: 100%;
            height: 190px;
            object-fit: cover;
        }

        .product-body {
            padding: 16px;
        }

        .product-body h6 {
            font-weight: 700;
            margin-bottom: 4px;
        }

        .category {
            font-size: 13px;
            color: #6c757d;
        }

        .price {
            font-weight: 800;
            color: #d97706;
            margin: 10px 0;
        }

        /* MOBILE */
        .mobile-card {
            display: flex;
            gap: 12px;
            background: #fff;
            padding: 12px;
            border-radius: 16px;
            margin-bottom: 12px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, .08);
        }

        .mobile-card img {
            width: 90px;
            height: 90px;
            object-fit: cover;
            border-radius: 12px;
        }

        .mobile-content {
            flex: 1;
        }

        .mobile-content h6 {
            font-weight: 700;
            font-size: 15px;
        }

        .mobile-actions {
            display: flex;
            gap: 8px;
            margin-top: 8px;
        }

        .d-actions {
            display: flex;
            gap: 8px;
        }

        .d-actions>a,
        .d-actions>form {
            flex: 1;
            /* equal width */
        }

        .d-actions .btn {
            width: 100%;
        }

        .pagination .page-link {
            border-radius: 50% !important;
            width: 38px;
            height: 38px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 600;
        }

        /* Active page highlight */
        .pagination .active .page-link {
            background-color: #f59e0b !important;
            /* honey yellow */
            border-color: #f59e0b !important;
            color: #7c2d12 !important;
            /* dark readable text */
        }
    </style>
</x-admin-layout>