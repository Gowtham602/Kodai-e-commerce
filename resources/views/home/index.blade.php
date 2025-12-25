<x-app-layout>

<!-- Bootstrap CSS (if not already included) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>

<style>
    .hero-swiper,
    .hero-swiper .swiper-slide {
        height: 50vh;
    }

    .hero-overlay {
        background: rgba(0, 0, 0, 0.5);
    }

    .rounded-4 {
        border-radius: 1.5rem;
    }

    .swiper-button-next,
    .swiper-button-prev {
        color: #fff;
    }

    .swiper-pagination-bullet-active {
        background: #198754; /* Bootstrap green */
    }
</style>
{{-- <p></p> --}}
{{-- <div class="container"> --}}
    <div class="container-fluid py-4 px-3 px-lg-5">

    <div class="swiper hero-swiper rounded-4 overflow-hidden shadow-lg position-relative">

        <div class="swiper-wrapper">

            <!-- Slide 1 -->
            <div class="swiper-slide position-relative"
                 style="background:url('https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=1920') center/cover no-repeat;">

                <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100"></div>

                <div class="position-relative h-100 d-flex align-items-center justify-content-center text-center text-white px-3">
                    <div class="col-lg-8">

                        <h1 class="display-5 fw-bold mb-3">
                            Welcome to <span class="text-success">Kodai Specials</span>
                        </h1>

                        <p class="lead mb-4">
                            Experience the authentic taste of Kodaikanal – the Princess of Hill Stations
                        </p>

                        <div class="d-flex justify-content-center gap-3">
                            <a href="{{ route('products.index') }}" class="btn btn-success btn-lg rounded-pill px-4">
                                Shop Now
                            </a>

                            <a href="{{ route('about') }}" class="btn btn-outline-light btn-lg rounded-pill px-4">
                                Learn More
                            </a>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="swiper-slide position-relative"
                 style="background:url('https://images.unsplash.com/photo-1511381939415-e44015466834?w=1920') center/cover no-repeat;">

                <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100"></div>

                <div class="position-relative h-100 d-flex align-items-center justify-content-center text-center text-white px-3">
                    <div class="col-lg-8">

                        <h1 class="display-5 fw-bold mb-3">
                            Handmade <span class="text-warning">Chocolates</span>
                        </h1>

                        <p class="lead mb-4">
                            Rich premium chocolates made with love in misty hills
                        </p>

                        <a href="{{ route('products.index') }}?category=chocolate"
                           class="btn btn-warning btn-lg rounded-pill px-4">
                            Explore Chocolates
                        </a>

                    </div>
                </div>
            </div>

        </div>

        <!-- Controls -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>

    </div>
</div>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script>
    new Swiper('.hero-swiper', {
        loop: true,
        autoplay: {
            delay: 4500,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
</script>

</x-app-layout>
