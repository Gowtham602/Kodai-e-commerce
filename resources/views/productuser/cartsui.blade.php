<div class="col-6 col-md-4 col-lg-4 col-xl-3">
    <div class="card product-card h-100 border-0">

        <div class="product-img-wrapper">
            <img src="{{ asset('storage/'.$product->image) }}"
                alt="{{ $product->name }}">
            <span class="badge bg-success product-badge">Fresh</span>
        </div>

        <div class="card-body d-flex flex-column p-2">

            <!-- <small class="text-muted text-uppercase category mt-1">
                {{ $product->category->name }}
            </small> -->

            <h6 class="product-title mt-1 mb-2">
                {{ $product->name }}
            </h6>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="product-weight">
                    {{ $product->weight }}
                </span>

                <h5 class="product-price mb-0 ">
                    ₹{{ $product->price }}
                </h5>
            </div>


            <button class="btn btn-success add-to-cart mb-2 mt-auto w-100"
                data-id="{{ $product->id }}"
                data-name="{{ $product->name }}"
                data-price="{{ $product->price }}"
                data-image="{{ $product->image }}">
                <i class="bi bi-cart me-2"></i>Add <span id="uicart">  to Cart</span>
            </button>

        </div>
    </div>
</div>