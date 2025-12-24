<div class="col-6 col-md-6 col-lg-6 col-xl-4">
    <div class="card product-card h-100 border-0">

        <!-- Image Wrapper -->
        <div class="product-img-wrapper">
            <img
                src="{{ asset('storage/'.$product->image) }}"
                alt="{{ $product->name }}"
            >
            <span class="badge bg-success product-badge">Fresh</span>
        </div>

        <div class="md-mt-5 card-body d-flex flex-column mt-2 p-3">

            <small class="text-muted text-uppercase category">
                {{ $product->category->name }}
            </small>

            <h6 class="product-title mt-1">
                {{ $product->name }}
            </h6>

            <p class="product-weight mb-2">
                {{ $product->weight }}
            </p>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="product-price mb-0">
                    ₹{{ $product->price }}
                </h5>
                <!-- <span class="rating">⭐ 4.5</span> -->
            </div>

            <button
                class="btn btn-success add-to-cart mt-auto w-100"
                data-id="{{ $product->id }}"
                data-name="{{ $product->name }}"
                data-price="{{ $product->price }}"
                data-image="{{ $product->image }}"
            >
                🛒 Add to Cart
            </button>
        </div>
    </div>
</div>
