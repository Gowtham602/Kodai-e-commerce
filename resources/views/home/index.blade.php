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
                                Welcome to <span class="text-warning1">Kodai Choco</span>
                            </h1>
                            <p class="lead mb-4">
                                Authentic taste from the hills of Kodaikanal
                            </p>
                            <a href="{{ route('products.index') }}" class="btn  btn-warning rounded-pill px-4 me-2">Shop Now</a>
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

<!-- ================= ABOUT US SECTION ================= -->
<section class="container my-5 about-section">
    <div class="row align-items-center g-4">

        <!-- TEXT -->
        <div class="col-lg-6">
            <h2 class="fw-bold mb-3">
                About <span class="text-warning">Kodai Choco</span>
            </h2>

            <p class="text-muted text-justify">
                Nestled in the misty hills of Kodaikanal, Kodai Choco brings you
                authentic, handmade chocolates crafted with love and tradition.
                Every bite reflects the purity of the hills and the richness of
                premium ingredients.
            </p>

            <a href="{{ route('about') }}"
               class="btn btn-warning rounded-pill px-4 mt-2">
                Know More
            </a>
        </div>

        <!-- IMAGE -->
        <div class="col-lg-6 text-center">
            <img
                src="https://images.unsplash.com/photo-1481391319762-47dff72954d9?q=80&w=1000&auto=format&fit=crop"
                class="img-fluid rounded-4 shadow-lg"
                alt="Kodai Chocolates">
        </div>

    </div>
</section>

<!-- ================= WHY CHOOSE US ================= -->
<section class="container my-5 why-choose-us">
    <div class="text-center mb-4">
        <h3 class="fw-bold">
            Why Choose <span class="text-warning">Kodai Choco</span>
        </h3>
        <p class="text-muted mb-0">
            What makes us special
        </p>
    </div>

    <!-- Swiper wrapper -->
    <div class="swiper choose-swiper">
        <div class="swiper-wrapper">

            <!-- Item 1 -->
            <div class="swiper-slide">
                <div class="choose-card text-center">
                    <div class="choose-icon">🍫</div>
                    <h6 class="fw-bold mt-3">Handmade Quality</h6>
                    <p class="text-muted small">
                        Crafted in small batches with traditional techniques.
                    </p>
                </div>
            </div>

            <!-- Item 2 -->
            <div class="swiper-slide">
                <div class="choose-card text-center">
                    <div class="choose-icon">🌿</div>
                    <h6 class="fw-bold mt-3">Natural Ingredients</h6>
                    <p class="text-muted small">
                        Premium cocoa, fresh nuts & fruits only.
                    </p>
                </div>
            </div>

            <!-- Item 3 -->
            <div class="swiper-slide">
                <div class="choose-card text-center">
                    <div class="choose-icon">🚚</div>
                    <h6 class="fw-bold mt-3">Fast Delivery</h6>
                    <p class="text-muted small">
                        Delivered fresh to your doorstep.
                    </p>
                </div>
            </div>

            <!-- Item 4 -->
            <div class="swiper-slide">
                <div class="choose-card text-center">
                    <div class="choose-icon">⭐</div>
                    <h6 class="fw-bold mt-3">Customer Trust</h6>
                    <p class="text-muted small">
                        Loved by thousands of happy customers.
                    </p>
                </div>
            </div>

        </div>

        <!-- pagination (mobile only) -->
        <div class="swiper-pagination choose-pagination mt-3"></div>
    </div>
</section>



    
   <section class=" container mb-5">
        <div
          class="whatsapp-banner d-flex flex-column flex-md-row justify-content-between align-items-center"
        >
          <div>
            <h4 class="fw-bold mb-2 text-center">
              NOW ORDER ON <i class="fa-brands fa-whatsapp"></i> WHATSAPP
            </h4>
            <p class="mb-0 fs-6">
              Get Instant delivery & exclusive offers via chat!
            </p>
          </div>
          <button
            class="btn btn-light text-warning fw-bold px-4 py-2 mt-3 mt-md-0 rounded-pill shadow-sm"
          >
            CHAT NOW
          </button>
        </div>
      </section>

    <!-- ================= TODAY DEAL SECTION ================= -->
    <!-- <section class="container my-3 rounded-4 overflow-hidden ">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold  mb-1">Today’s Deals</h4>
                <small class="fw-bold text-warning ">Limited time offers</small>
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

                            <button class="btn btn-warning rounded-pill w-100 mt-2">
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

    <!-- ================= TESTIMONIAL SECTION ================= -->
<section class="container my-5">
    <div class="text-center mb-4">
        <h3 class="fw-bold">What Our Customers Say</h3>
        <p class="text-muted mb-0">
            Real reviews from chocolate lovers ❤️
        </p>
    </div>

    <div class="swiper testimonial-swiper">
        <div class="swiper-wrapper">

            <!-- Testimonial 1 -->
            <div class="swiper-slide">
                <div class="testimonial-card">
                    <p class="testimonial-text">
                        “The chocolates are incredibly fresh and rich in taste.
                        You can really feel the quality!”
                    </p>
                    <div class="testimonial-user">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg">
                        <div>
                            <h6 class="mb-0">Anitha R</h6>
                            <small class="text-muted">Chennai</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Testimonial 2 -->
            <div class="swiper-slide">
                <div class="testimonial-card">
                    <p class="testimonial-text">
                        “Absolutely loved the fruit filling chocolates.
                        Perfect balance of sweetness and flavor.”
                    </p>
                    <div class="testimonial-user">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg">
                        <div>
                            <h6 class="mb-0">Rahul K</h6>
                            <small class="text-muted">Bangalore</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Testimonial 3 -->
            <div class="swiper-slide">
                <div class="testimonial-card">
                    <p class="testimonial-text">
                        “Fast delivery and amazing quality.
                        Kodai Choco never disappoint!”
                    </p>
                    <div class="testimonial-user">
                        <img src="https://randomuser.me/api/portraits/women/68.jpg">
                        <div>
                            <h6 class="mb-0">Priya S</h6>
                            <small class="text-muted">Coimbatore</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Testimonial 4 -->
            <div class="swiper-slide">
                <div class="testimonial-card">
                    <p class="testimonial-text">
                        “Reminds me of my Kodaikanal trips.
                        Authentic taste and premium feel.”
                    </p>
                    <div class="testimonial-user">
                        <img src="https://randomuser.me/api/portraits/men/45.jpg">
                        <div>
                            <h6 class="mb-0">Suresh M</h6>
                            <small class="text-muted">Madurai</small>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="swiper-pagination testimonial-pagination mt-3"></div>
    </div>
</section>





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

<script>
new Swiper('.testimonial-swiper', {
    loop: true,
    spaceBetween: 20,
    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
    },
    pagination: {
        el: '.testimonial-pagination',
        clickable: true,
    },
    breakpoints: {
        0: {          // Mobile
            slidesPerView: 1
        },
        768: {        // Tablet
            slidesPerView: 3
        },
        1200: {       // Desktop
            slidesPerView: 3
        }
    }
});
</script>

<script>
new Swiper('.choose-swiper', {
    loop: true,
    spaceBetween: 16,
    autoplay: {
        delay: 2800,
        disableOnInteraction: false,
    },
    pagination: {
        el: '.choose-pagination',
        clickable: true,
    },
    breakpoints: {
        0: {          // Mobile
            slidesPerView: 1
        },
        768: {        // Tablet & above
            slidesPerView: 4,
            allowTouchMove: false
        }
    }
});
</script>


</x-app-layout>