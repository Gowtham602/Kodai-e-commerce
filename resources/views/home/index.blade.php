<x-app-layout>

    <!-- Bootstrap important -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>



    <!-- ================= HERO SECTION ================= -->
    <div class="container-fluid px-3 px-lg-5 home-m">

        <div class="swiper hero-swiper rounded-4 shadow-lg overflow-hidden">
            <div class="swiper-wrapper">

                <!-- Slide 1 -->
                <div class="swiper-slide position-relative"
                    style="background:url('https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=1920') center/cover;">
                    <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100"></div>
                    <div class="position-relative h-100 d-flex align-items-center justify-content-center text-center text-white">
                        <div>
                            <h1 class="fw-bold mb-3">
                                Welcome to <span class="text-success">Kodai Chocolates</span>
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

    {{-- 14 product scrollinf design  --}}
    <section class="home-marquee-section py-4">
        <div class="container">

            <!-- TITLE -->
            <div class="text-center mb-4">
                <h3 class="fw-bold">Kodai Chocolate Collection</h3>
                <p class="text-muted mb-0">
                    Handpicked products from Kodaikanal
                </p>
            </div>

            <!-- MARQUEE -->
            <div class="marquee-wrapper">
                <div class="marquee-scroll">
                    <div class="marquee-track">

                        <!-- ITEM -->
                        <div class="marquee-item">
                            <img src="https://images.unsplash.com/photo-1606312619070-d48b4c652a52" alt="">
                            <span>Fluffy</span>
                        </div>

                        <div class="marquee-item">
                            <img src="https://images.unsplash.com/photo-1541781774459-bb2af2f05b55" alt="">
                            <span>Toys</span>
                        </div>

                        <div class="marquee-item">
                            <img src="https://images.unsplash.com/photo-1587049352851-8d4e89133924" alt="">
                            <span>Honey</span>
                        </div>

                        <div class="marquee-item">
                            <img src="https://images.unsplash.com/photo-1621939514649-280e2ee25f60" alt="">
                            <span>Stone & Gems Chocolate</span>
                        </div>

                        {{-- <div class="marquee-item">
                    <img src="https://images.unsplash.com/photo-1590080877777-0f7c2d71a8a5" alt="">
                    <span>Fruit Bars</span>
                </div> --}}

                        {{-- <div class="marquee-item"> --}}
                        <div class="marquee-item">
                            <img src="https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=400&q=80" alt="Fruit Filling Chocolates">
                            <span>Fruit Filling Chocolates</span>
                        </div>



                        <div class="marquee-item">
                            <img src="https://images.unsplash.com/photo-1509042239860-f550ce710b93" alt="">
                            <span>Tea</span>
                        </div>

                        <div class="marquee-item">
                            <img src="https://images.unsplash.com/photo-1615484477778-ca3b77940c25" alt="">
                            <span>Essential Oils</span>
                        </div>



                        <div class="marquee-item">
                            <img src="https://images.unsplash.com/photo-1596462502278-27bfdc403348?w=400&q=80" alt="Cosmetics">
                            <span>Cosmetics</span>
                        </div>



                        <div class="marquee-item">
                            <img src="https://images.unsplash.com/photo-1600891964599-f61ba0e24092?w=400&q=80" alt="Health Products">
                            <span>Health Products</span>
                        </div>
                        <!-- DUPLICATE ITEMS (for smooth infinite scroll) -->
                        <!-- <div class="marquee-item">
                            <img src="https://images.unsplash.com/photo-1606312619070-d48b4c652a52" alt="">
                            <span>Fluffy</span>
                        </div> -->
                        <!-- repeat same list again -->


                        <!-- DUPLICATE FOR INFINITE LOOP -->
                         <div class="marquee-item">
                            <img src="https://images.unsplash.com/photo-1606312619070-d48b4c652a52" alt="">
                            <span>Fluffy</span>
                        </div>

                        <div class="marquee-item">
                            <img src="https://images.unsplash.com/photo-1541781774459-bb2af2f05b55" alt="">
                            <span>Toys</span>
                        </div>

                        <div class="marquee-item">
                            <img src="https://images.unsplash.com/photo-1587049352851-8d4e89133924" alt="">
                            <span>Honey</span>
                        </div>

                        <div class="marquee-item">
                            <img src="https://images.unsplash.com/photo-1621939514649-280e2ee25f60" alt="">
                            <span>Stone & Gems Chocolate</span>
                        </div>
                         <div class="marquee-item">
                            <img src="https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=400&q=80" alt="Fruit Filling Chocolates">
                            <span>Fruit Filling Chocolates</span>
                        </div>



                        <div class="marquee-item">
                            <img src="https://images.unsplash.com/photo-1509042239860-f550ce710b93" alt="">
                            <span>Tea</span>
                        </div>

                        <div class="marquee-item">
                            <img src="https://images.unsplash.com/photo-1615484477778-ca3b77940c25" alt="">
                            <span>Essential Oils</span>
                        </div>



                        <div class="marquee-item">
                            <img src="https://images.unsplash.com/photo-1596462502278-27bfdc403348?w=400&q=80" alt="Cosmetics">
                            <span>Cosmetics</span>
                        </div>



                        <div class="marquee-item">
                            <img src="https://images.unsplash.com/photo-1600891964599-f61ba0e24092?w=400&q=80" alt="Health Products">
                            <span>Health Products</span>
                        </div>

                        <!-- copy same items again (important) -->

                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ================= TODAY DEAL SECTION ================= -->
    <!-- <section class="container my-3 rounded-4 overflow-hidden ">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold  mb-1">Today’s Deals</h4>
                <small class="fw-bold text-success ">Limited time offers</small>
            </div>
            <span class="badge bg-danger text-white rounded-pill px-3 py-2">Flash Sale</span>
        </div>

        <div class="swiper todayDealSwiper ">
            <div class="swiper-wrapper">

                @foreach($todayDeals as $deal)
                <div class="swiper-slide">
                    <div class="deal-card">

                        <div class="deal-img">
                            <img src="/storage/{{ $deal->product->image }}">
                            <span class="deal-badge">Today Only</span>
                        </div>

                        <div class="deal-body">
                            <h6 class="fw-semibold ">{{ $deal->product->name }}</h6>

                            <div class="price-box mb-2">
                                <span class="old-price">₹{{ $deal->product->price }}</span>
                                <span class="new-price">₹{{ $deal->deal_price }}</span>
                            </div>

                            <div class="countdown" data-end="{{ $deal->end_time }}">
                                ⏳ Loading...
                            </div> 

                            <button class="btn btn-success rounded-pill w-100 mt-2">
                                Buy Now
                            </button>
                        </div>

                    </div>
                </div>
                @endforeach

            </div>

            <div class="swiper-pagination today-pagination mt-3"></div>
        </div>

    </section> -->

    <!-- ================= JS ================= -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

    <script>
/* HERO SWIPER */
new Swiper('.hero-swiper', {
    loop: true,
    autoplay: {
        delay: 4500
    },
    pagination: {
        el: '.hero-pagination',
        clickable: true
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    }
});

/* TODAY DEALS SWIPER */
new Swiper('.todayDealSwiper', {
    spaceBetween: 16,
    grabCursor: true,

    pagination: {
        el: '.today-pagination',
        clickable: true
    },

    breakpoints: {
        0: {                // Mobile
            slidesPerView: 2
        },
        768: {              // Tablet
            slidesPerView: 4
        },
        1200: {             // Laptop & above
            slidesPerView: 6
        }
    }
});

/* COUNTDOWN */
setInterval(() => {
    document.querySelectorAll('.countdown').forEach(el => {
        let end = new Date(el.dataset.end).getTime();
        let now = new Date().getTime();
        let diff = end - now;

        if (diff <= 0) {
            el.innerHTML = "Deal ended";
            el.closest('.deal-card')?.classList.add('opacity-50');
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