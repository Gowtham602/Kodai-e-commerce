<x-app-layout>
    <!-- Page Header -->
    <div class="pt-4">
    <div class="bg-success text-white py-5 mb-4 ">
        <div class="container text-center">
            <h1 class="fw-bold">Kodaikanal</h1>
            <p class="lead mb-0">The Princess of Hill Stations</p>
        </div>
    </div>

    <!-- About Section -->
    <div class="container mb-5">
        <div class="row align-items-center g-4">
            <!-- Text Content -->
            <div class="col-md-6">
                <h2 class="fw-bold mb-3 text-success">About Kodai Specials</h2>

                <p class="text-muted">
                    <strong>Kodai Specials</strong> is an online store bringing the authentic taste
                    and freshness of Kodaikanal directly to your home.
                </p>

                <p class="text-muted">
                    From rich homemade chocolates to carefully selected herbal products,
                    our collections are inspired by the cool climate, misty hills,
                    and green forests of Kodaikanal in Tamil Nadu.
                </p>

                <p class="text-muted">
                    Each product is sourced and packed with love so that you can enjoy
                    the true <strong>“Kodai”</strong> experience wherever you are.
                </p>

                <a href="{{ route('products.index') }}" class="btn btn-success px-4 mt-3">
                    Shop Now
                </a>
            </div>

            <!-- Image -->
            <div class="col-md-6 text-center">
                <img
                    src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4"
                    alt="Kodaikanal"
                    class="img-fluid rounded shadow"
                >
            </div>
        </div>
    </div>

    <!-- Feature Section -->
    <div class="bg-light py-5">
        <div class="container">
            <div class="row text-center g-4">
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="fw-bold text-success">🌿 Natural Products</h5>
                            <p class="text-muted mb-0">
                                Pure and carefully selected herbal and natural items.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="fw-bold text-success">🍫 Homemade Chocolates</h5>
                            <p class="text-muted mb-0">
                                Authentic Kodai-style handmade chocolates.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="fw-bold text-success">📦 Packed with Care</h5>
                            <p class="text-muted mb-0">
                                Freshly packed to preserve taste and quality.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

</x-app-layout>
