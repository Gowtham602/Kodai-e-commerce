<x-app-layout>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Swiper -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>

<style>
/* ================= HERO ================= */
.hero-swiper,
.hero-swiper .swiper-slide {
    height: 50vh;
}

.hero-overlay {
    background: rgba(0,0,0,0.55);
}

.swiper-button-next,
.swiper-button-prev {
    color: #fff;
}

/* ================= TODAY DEAL ================= */
.deal-card {
    background: #fff;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 15px 40px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    height: 100%;
}

.deal-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 25px 55px rgba(0,0,0,0.12);
}

.deal-img {
    position: relative;
}

.deal-img img {
    width: 100%;
    height: 220px;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.deal-card:hover img {
    transform: scale(1.08);
}

.deal-badge {
    position: absolute;
    top: 12px;
    left: 12px;
    background: linear-gradient(135deg, #dc3545, #ff6b6b);
    color: #fff;
    padding: 6px 12px;
    font-size: 12px;
    border-radius: 999px;
    font-weight: 600;
}

.deal-body {
    padding: 16px;
    display: flex;
    flex-direction: column;
}

.price-box {
    display: flex;
    gap: 10px;
    align-items: center;
}

.old-price {
    text-decoration: line-through;
    color: #adb5bd;
}

.new-price {
    color: #198754;
    margin-left:10px ;
    font-size: 20px;
    font-weight: 700;
}

.countdown {
    margin-top: 10px;
    font-size: 13px;
    font-weight: 600;
    background: #fff5f5;
    color: #dc3545;
    padding: 6px 10px;
    border-radius: 10px;
    text-align: center;
}

/* Mobile */
@media (max-width: 576px) {
    .deal-img img {
        height: 180px;
    }
}
</style>

<!-- ================= HERO SECTION ================= -->
<div class="container-fluid py-4 px-3 px-lg-5">

<div class="swiper hero-swiper rounded-4 shadow-lg overflow-hidden">
    <div class="swiper-wrapper">

        <!-- Slide 1 -->
        <div class="swiper-slide position-relative"
             style="background:url('https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=1920') center/cover;">
            <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100"></div>
            <div class="position-relative h-100 d-flex align-items-center justify-content-center text-center text-white">
                <div>
                    <h1 class="fw-bold mb-3">
                        Welcome to <span class="text-success">Kodai Specials</span>
                    </h1>
                    <p class="lead mb-4">
                        Authentic taste from the hills of Kodaikanal
                    </p>
                    <a href="{{ route('products.index') }}" class="btn btn-success rounded-pill px-4 me-2">Shop Now</a>
                    <a href="{{ route('about') }}" class="btn btn-outline-light rounded-pill px-4">Learn More</a>
                </div>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="swiper-slide position-relative"
             style="background:url('https://images.unsplash.com/photo-1511381939415-e44015466834?w=1920') center/cover;">
            <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100"></div>
            <div class="position-relative h-100 d-flex align-items-center justify-content-center text-center text-white">
                <div>
                    <h1 class="fw-bold mb-3">
                        Handmade <span class="text-warning">Chocolates</span>
                    </h1>
                    <p class="lead mb-4">
                        Premium handmade hill-station chocolates
                    </p>
                    <a href="{{ route('products.index') }}?category=chocolate"
                       class="btn btn-warning rounded-pill px-4">
                        Explore Chocolates
                    </a>
                </div>
            </div>
        </div>

    </div>

    {{-- <div class="swiper-button-next"></div> --}}
    {{-- <div class="swiper-button-prev"></div> --}}
    {{-- <div class="swiper-pagination hero-pagination"></div> --}}
</div>

</div>

<!-- ================= TODAY DEAL SECTION ================= -->
<section class="container my-5 shadow-lg rounded-4 overflow-hidden">

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mt-4 mb-1">🔥 Today’s Deals</h4>
        <small class="fw-bold text-success ps-4">Limited time offers</small>
    </div>
    <span class="badge bg-danger text-white rounded-pill px-3 py-2">Flash Sale</span>
</div>

<div class="swiper todayDealSwiper">
    <div class="swiper-wrapper">

        @foreach($todayDeals as $deal)
        <div class="swiper-slide">
            <div class="deal-card">

                <div class="deal-img">
                    <img src="/storage/{{ $deal->product->image }}">
                    <span class="deal-badge">Today Only</span>
                </div>

                <div class="deal-body">
                    <h6 class="fw-semibold">{{ $deal->product->name }}</h6>

                    <div class="price-box mb-2">
                        <span class="old-price">₹{{ $deal->product->price }}</span>
                        <span class="new-price">₹{{ $deal->deal_price }}</span>
                    </div>

                    <div class="countdown" data-end="{{ $deal->end_time }}">
                        ⏳ Loading...
                    </div>

                    <button class="btn btn-success rounded-pill w-100 mt-3">
                        Buy Now
                    </button>
                </div>

            </div>
        </div>
        @endforeach

    </div>

    <div class="swiper-pagination today-pagination mt-3"></div>
</div>

</section>

<!-- ================= JS ================= -->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

<script>
/* Hero */
new Swiper('.hero-swiper', {
    loop: true,
    autoplay: { delay: 4500 },
    pagination: { el: '.hero-pagination', clickable: true },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    }
});

/* Today Deals */
new Swiper('.todayDealSwiper', {
    slidesPerView: 1.2,
    spaceBetween: 16,
    pagination: { el: '.today-pagination', clickable: true },
    breakpoints: {
        576: { slidesPerView: 2.2 },
        768: { slidesPerView: 3 },
        1200: { slidesPerView: 4 }
    }
});

/* Countdown */
setInterval(() => {
    document.querySelectorAll('.countdown').forEach(el => {
        let end = new Date(el.dataset.end).getTime();
        let now = new Date().getTime();
        let diff = end - now;

        if (diff <= 0) {
            el.innerHTML = "Deal ended";
            el.closest('.deal-card').classList.add('opacity-50');
            return;
        }

        let h = Math.floor(diff / (1000 * 60 * 60));
        let m = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        let s = Math.floor((diff % (1000 * 60)) / 1000);

        el.innerHTML = `⏳ ${h}h ${m}m ${s}s`;
    });
}, 1000);
</script>

</x-app-layout>
