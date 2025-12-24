
<div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
    <div class="card product-card h-100 shadow-sm border-0">

        <img
            src="{{ asset('storage/'.$product->image) }}"
            class="card-img-top"
            alt="{{ $product->name }}"
        >

        <div class="card-body d-flex flex-column">
            <small class="text-muted">
                {{ $product->category->name }}
            </small>

            <h6 class="fw-bold mt-1">
                {{ $product->name }}
            </h6>

            <p class="mb-1">{{ $product->weight }}</p>

            <h5 class="text-success mb-3">
                ₹{{ $product->price }}
            </h5>

            <button
                class="btn btn-success mt-auto w-100 add-to-cart"
                data-id="{{ $product->id }}"
                data-name="{{ $product->name }}"
                data-price="{{ $product->price }}"
                data-image="{{ $product->image }}"
            >
                Add to Cart
            </button>
        </div>
    </div>
</div>

