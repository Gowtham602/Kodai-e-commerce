<x-app-layout>
    <style>
        /* Sidebar background */
.card {
    background: #fff;
}

/* Custom checkbox style */
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

/* Hover effect */
.custom-check:hover {
    background: #f8f9fa;
    border-radius: 6px;
    /* padding-left: 1px; */
    transition: 0.2s;
}
.test{
    color:green;
}
/* Premium header container */
.premium-header {
    background: linear-gradient(
        135deg,
        rgba(25, 135, 84, 0.08),
        rgba(255, 255, 255, 0.9)
    );
    border: 1px solid rgba(0,0,0,0.05);
    border-radius: 18px;
    padding: 20px 24px;
    backdrop-filter: blur(6px);
}

/* Sort section */
.sort-wrapper {
    display: flex;
    align-items: center;
    gap: 10px;
    background: #fff;
    padding: 8px 14px;
    border-radius: 999px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}

/* Sort label */
/* Wrapper */
.sort-wrapper {
    display: flex;
    align-items: center;
    gap: 10px;
    background: #ffffff;
    padding: 10px 14px;
    border-radius: 999px;
    box-shadow: 0 12px 30px rgba(0,0,0,0.12);
    border: 1px solid rgba(0,0,0,0.06);
}

/* Label */
.sort-label {
    background: linear-gradient(135deg, #198754, #2ecc71);
    color: #fff;
    font-size: 12px;
    font-weight: 600;
    padding: 6px 12px;
    border-radius: 999px;
    letter-spacing: 0.6px;
    text-transform: uppercase;
}

/* Select */
.sort-select {
    border: none;
    font-size: 14px;
    min-width: 200px;
    padding: 6px 36px 6px 10px;
    border-radius: 999px;
    background-color: #f8f9fa;
    cursor: pointer;
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background-image:
        linear-gradient(45deg, transparent 50%, #198754 50%),
        linear-gradient(135deg, #198754 50%, transparent 50%);
    background-position:
        calc(100% - 18px) calc(50% - 2px),
        calc(100% - 13px) calc(50% - 2px);
    background-size: 5px 5px;
    background-repeat: no-repeat;
}

/* Focus state */
.sort-select:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(25,135,84,0.25);
}

/* Option styling (limited support) */
.sort-select option {
    font-size: 14px;
    padding: 10px;
}


/* Mobile adjustments */
@media (max-width: 576px) {
    .premium-header {
        padding: 16px;
    }
    .sort-wrapper {
        width: 100%;
        justify-content: space-between;
    }
}


    </style>

<div class="container-fluid px-3 px-lg-5 py-4">
    <div class="row g-4">

        {{-- SIDEBAR FILTER --}}
        <div class="col-lg-3 col-md-4">

            <div class="card border-0 shadow-sm rounded-4 sticky" style="top:90px;">
                <div class="card-body">

                    <h5 class="fw-bold mb-4 border-bottom pb-2">
                        <i class="bi bi-funnel me-2 text-success"></i> Filters
                    </h5>

                    <h6 class="fw-bold mb-3 test">Categories</h6>

                    @foreach($categories as $cat)
                        <div class="form-check custom-check mb-2">
                            <input
                                class="form-check-input category-filter"
                                type="checkbox"
                                value="{{ $cat->id }}"
                                id="cat-{{ $cat->id }}"
                            >
                            <label class="form-check-label fw-semibold" for="cat-{{ $cat->id }}">
                                {{ $cat->name }}
                            </label>
                        </div>
                    @endforeach

                </div>
            </div>

        </div>

        {{-- PRODUCT LIST --}}
        <div class="col-lg-9 col-md-8">

            {{-- Header --}}
        <!-- PREMIUM PRODUCT HEADER -->
<div class="premium-header mb-4">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">

        <!-- Left -->
        <div>
            <h4 class="fw-bold mb-1 text-green-700">
                Products
            </h4>
            <p class="text-muted small mb-0">
                Koodai  Specials Products for you try and enjoy your day
            </p>
        </div>

        <!-- Right -->
        <div class="sort-wrapper">
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




           {{-- Products Grid --}}
<div class="row g-4" id="product-list">
    @forelse($products as $product)
        @include('productuser.cartsui', ['product' => $product])
    @empty
        <div class="col-12 text-center text-muted py-5">
            No products found
        </div>
    @endforelse
</div>

{{-- PAGINATION (MUST BE HERE) --}}
@if($products instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <div id="pagination-wrapper" class="mt-5 d-flex justify-content-center">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
@endif

            

        </div>

    </div>
</div>




</x-app-layout>
