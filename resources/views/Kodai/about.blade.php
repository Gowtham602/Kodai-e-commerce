<x-app-layout>
<style>
    /* HERO */
.hero-section {
    background: linear-gradient(135deg, #0c3422, #ddf1cf);
    position: relative;
}

.hero-blur {
    position: absolute;
    bottom: -80px;
    left: 50%;
    width: 300px;
    height: 300px;
    background: rgba(255,255,255,0.15);
    filter: blur(100px);
    transform: translateX(-50%);
}
.hero-section .container {
    position: relative;
    z-index: 2;
}

.hero-blur {
    z-index: 1;
}


/* ABOUT IMAGE */
.about-img {
    transition: transform .4s ease;
    max-height: 300px;
}
.about-img:hover {
    transform: scale(1.03);
}

/* FEATURES */
.feature-card {
    background: #fff;
    border-radius: 16px;
    padding: 30px 25px;
    text-align: center;
    box-shadow: 0 10px 25px rgba(0,0,0,0.06);
    transition: all .3s ease;
}
.feature-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.12);
}

.feature-card .icon {
    font-size: 2.5rem;
}

</style>
<!-- HERO SECTION -->
<section class="hero-section position-relative overflow-hidden">
    <div class="container py-5 text-center text-white">
        <span class="badge bg-light text-success px-3 py-2 mb-3 fw-semibold">
            Princess of Hill Stations
        </span>

        <h1 class="display-5 fw-bold mt-3">
            Kodaikanal
        </h1>

        <p class="lead opacity-75 mt-3">
            Experience the freshness, flavor, and serenity of Kodai
        </p>

        <a href="{{ route('products.index') }}"
           class="btn btn-success btn-lg rounded-pill px-5 mt-4 shadow">
            Shop Kodai Specials
    </a>
    </div>

    <!-- Decorative blur -->
    <div class="hero-blur"></div>
</section>

<!-- ABOUT SECTION -->
<section class="container py-4">
    <div class="row align-items-center g-5">
                <!-- TEXT -->
        <div class="col-lg-7">
            <h2 class="fw-bold text-success mb-3">
                About Kodai Specials
            </h2>

            <p class="text-muted">
                <strong>Kodai Specials</strong> brings the authentic taste and
                freshness of Kodaikanal directly to your doorstep.
            </p>

            <p class="text-muted text-justify">
                From homemade chocolates to herbal and natural products,
                every item is inspired by the misty hills and cool climate
                of Tamil Nadu’s most loved hill station.
            </p>

            <p class="text-muted">
                Carefully sourced, freshly packed, and delivered with care —
                so you enjoy the true Kodai experience anywhere.
            </p>

            <a href="{{ route('products.index') }}"
               class="btn btn-outline-success rounded-pill px-4 mt-3">
                Explore Products →
            </a>
        </div>

        <!-- IMAGE -->
        <div class="col-lg-5 text-center">
            <img
                src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4"
                alt="Kodaikanal Hills"
                class="img-fluid rounded-4 shadow-lg about-img"
            >
        </div>

    </div>
</section>

<!-- FEATURES -->
<section class="bg-light py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h3 class="fw-bold">Why Kodai Specials?</h3>
            <p class="text-muted mb-0">
                Quality, freshness, and authenticity — always
            </p>
        </div>

        <div class="row g-4">

            <!-- CARD 1 -->
            <div class="col-md-4">
                <div class="feature-card h-100">
                    <div class="icon">🌿</div>
                    <h5 class="fw-semibold mt-3">
                        Natural Products
                    </h5>
                    <p class="text-muted small">
                        Pure herbal and natural items sourced carefully
                        from Kodai region.
                    </p>
                </div>
            </div>

            <!-- CARD 2 -->
            <div class="col-md-4">
                <div class="feature-card h-100">
                    <div class="icon">🍫</div>
                    <h5 class="fw-semibold mt-3">
                        Homemade Chocolates
                    </h5>
                    <p class="text-muted small">
                        Authentic Kodai-style handmade chocolates,
                        loved by everyone.
                    </p>
                </div>
            </div>

            <!-- CARD 3 -->
            <div class="col-md-4">
                <div class="feature-card h-100">
                    <div class="icon">📦</div>
                    <h5 class="fw-semibold mt-3">
                        Packed with Care
                    </h5>
                    <p class="text-muted small">
                        Freshly packed to preserve taste, aroma,
                        and quality.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

</x-app-layout>
