<x-app-layout>

    <style>
        /* ================== COMMON ================== */
        .card {
            background: #fff;
        }

        .custom-check .form-check-input {
            border-radius: 4px;
            cursor: pointer;
        }

        .custom-check .form-check-input:checked {
            background-color: #198754;
            border-color: #198754;
        }

        .custom-check .form-check-label {
            cursor: pointer;
            font-size: 0.95rem;
        }

        .custom-check:hover {
            background: #f8f9fa;
            border-radius: 6px;
            transition: 0.2s;
        }

        .test {
            color: #7c2d12;
            ;
        }

        /* ================== DESKTOP STICKY FILTER ================== */
        @media (min-width: 577px) {
            .desktop-filter {
                position: sticky;
                top: 90px;
            }
        }

        /* ================== HEADER ================== */
        .premium-header {
            background: linear-gradient(135deg,
                    rgba(245, 158, 11, 0.12),
                    /* light honey tint */
                    rgba(255, 255, 255, 0.95));

            border-radius: 18px;
            padding: 15px 24px;
            margin-top: 10px;
        }

        /* ================== SORT ================== */
        .sort-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #fff;
            padding: 10px 14px;
            border-radius: 999px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
        }

        .sort-label {
            background: linear-gradient(135deg,
                    #fbbf24,
                    #fde68a);

            color: #fff;
            font-size: 12px;
            font-weight: 600;
            padding: 6px 12px;
            border-radius: 999px;
        }

        .sort-select {
            border: none;
            font-size: 14px;
            padding: 6px 36px 6px 10px;
            border-radius: 999px;
            background-color: #f8f9fa;
            cursor: pointer;
        }

        /* ================== PAGINATION ================== */
        .pagination {
            gap: 6px;
        }

        .pagination .page-item .page-link {
            border-radius: 10px;
            border: none;
            padding: 8px 14px;
            font-weight: 500;
            color: #92400e;
            /* dark honey text */
            background: #fff7cc;
            /* soft honey bg */
            transition: all 0.2s ease;
        }

        .pagination .page-item .page-link:hover {
            background: #f59e0b;
            /* honey yellow */
            color: #7c2d12;
            /* dark readable text */
        }

        .pagination .page-item.active .page-link {
            background: #f59e0b;
            /* solid honey (no gradient) */
            color: #7c2d12;
            box-shadow: 0 6px 16px rgba(245, 158, 11, 0.35);
        }

        .pagination .page-item.disabled .page-link {
            background: #f1f3f5;
            /* unchanged neutral */
            color: #adb5bd;
        }


        /* Mobile compact pagination */
        @media (max-width: 576px) {
            .pagination .page-link {
                padding: 6px 10px;
                font-size: 13px;
            }

            .koodai-spec {
                display: none;
            }
        }


        /* ================== MOBILE OFFCANVAS ================== */
        @media (max-width: 576px) {
            .offcanvas {
                border-radius: 16px 0 0 16px;
            }

            #mobileFilter {
                width: 80% !important;
                /* change to 70%, 75%, 85% as you like */
                max-width: 250px;
                /* optional: prevents too wide on large phones */
            }

            #mobileFilter .offcanvas-body {
                overflow-y: auto;
                max-height: calc(100vh - 56px);
                /* subtract header height */
                padding-bottom: 80px;
                /* prevents last item being hidden */
            }

            .product-page {
                padding-top: 0 !important;
            }
        }
    </style>

    <div class="container-fluid product-page px-3 px-lg-3 py-4">
        <div class="row g-3 ">

            {{-- ================= DESKTOP / TABLET FILTER ================= --}}
            <div class="col-lg-3 col-md-4 d-none d-sm-block">
                <div class="card border-0 shadow-sm rounded-4 desktop-filter">
                    <div class="card-body">

                        <h5 class="fw-bold mb-4 border-bottom pb-2">
                            <i class="bi bi-funnel me-2 text-warning"></i> Filters
                        </h5>

                        <h6 class="fw-bold mb-3 test">Categories</h6>

                        @foreach($categories as $cat)
                        <div class="form-check custom-check mb-2">
                            <input class="form-check-input category-filter"
                                type="checkbox"
                                value="{{ $cat->id }}"
                                id="cat-{{ $cat->id }}">
                            <label class="form-check-label fw-semibold"
                                for="cat-{{ $cat->id }}">
                                {{ $cat->name }}
                            </label>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>

            {{-- ================= PRODUCTS ================= --}}
            <div class="col-lg-9 col-md-8">

                {{-- MOBILE FILTER BUTTON --}}
                <button class="btn btn-warning w-100 mb-3 d-sm-none"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#mobileFilter">
                    <i class="bi bi-funnel me-2"></i> Filters
                </button>

                {{-- HEADER + SORT --}}
                <div class="premium-header mb-4">
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                        <div>
                            <h4 class="koodai-spec fw-bold mb-1">Products</h4>
                            <p class="koodai-spec text-muted small mb-0">
                                Koodai Chocolates Products for you
                            </p>
                        </div>

                        <div class="sort-wrapper ">
                            <span class="sort-label">Sort</span>
                            <select class="form-select sort-select" id="sortBy">
                                <option value="">Recommended</option>
                                <option value="latest">Newest</option>
                                <option value="price_low">Price ↑ Low to High</option>
                                <option value="price_high">Price ↓ High to Low</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- PRODUCTS GRID --}}
                <div class="row g-4" id="product-list">
                    @forelse($products as $product)
                    @include('productuser.cartsui', ['product' => $product])
                    @empty
                    <div class="col-12 text-center py-5 text-muted">
                        No products found
                    </div>
                    @endforelse
                </div>

                {{-- PAGINATION --}}
                @if($products instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <div id="pagination-wrapper" class="mt-3 d-flex justify-content-center">
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
                @endif

            </div>
        </div>
    </div>

    {{-- ================= MOBILE FILTER OFFCANVAS ================= --}}
    <div class="offcanvas offcanvas-end d-sm-none" tabindex="-1" id="mobileFilter">
        <div class="offcanvas-header border-bottom">
            <h5 class="fw-bold mb-0">
                <i class="bi bi-funnel me-2 text-warning"></i> Filters
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>



        <div class="offcanvas-body">

            <h6 class="fw-bold mb-3 test">Categories</h6>

            @foreach($categories as $cat)
            <div class="form-check custom-check mb-2">
                <input class="form-check-input category-filter"
                    type="checkbox"
                    value="{{ $cat->id }}"
                    id="mcat-{{ $cat->id }}">
                <label class="form-check-label fw-semibold"
                    for="mcat-{{ $cat->id }}">
                    {{ $cat->name }}
                </label>
            </div>
            @endforeach

        </div>
    </div>

</x-app-layout>