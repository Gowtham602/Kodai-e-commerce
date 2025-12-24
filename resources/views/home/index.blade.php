<x-app-layout>
    <!-- Include Swiper CSS -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"
    />

    <div class="pt-5 swiper hero-swiper h-[80vh] relative">
        <div class="swiper-wrapper">
            <!-- Slide 1 -->
            <div class="swiper-slide bg-cover bg-center relative" style="background-image: url('https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=1920');">
                <div class="slide-overlay absolute inset-0 bg-black opacity-40"></div>
                <div class="hero-content absolute inset-0 flex flex-col items-center justify-center text-center text-white px-4">
                    <h1 class="hero-title text-4xl md:text-6xl font-bold mb-4">Welcome to Kodai Specials</h1>
                    <p class="hero-subtitle text-lg md:text-2xl mb-6">
                        Experience the authentic taste of Kodaikanal - The Princess of Hill Stations
                    </p>
                    <div class="hero-buttons space-x-4">
                        <a href="{{Route('products.index')}}" class="btn btn-hero btn-hero-primary px-6 py-3 rounded-lg bg-green-600 hover:bg-green-700 transition">Shop Now</a>
                        <a href="#about" class="btn btn-hero btn-hero-outline px-6 py-3 rounded-lg border border-white hover:bg-white hover:text-green-600 transition">Learn More</a>
                    </div>
                </div>
            </div>
            <!-- Slide 2 -->
            <div class="swiper-slide bg-cover bg-center relative" style="background-image: url('https://images.unsplash.com/photo-1511381939415-e44015466834?w=1920');">
                <div class="slide-overlay absolute inset-0 bg-black opacity-40"></div>
                <div class="hero-content absolute inset-0 flex flex-col items-center justify-center text-center text-white px-4">
                    <h1 class="hero-title text-4xl md:text-6xl font-bold mb-4">Handcrafted Chocolates</h1>
                    <p class="hero-subtitle text-lg md:text-2xl mb-6">
                        Rich, premium chocolates made with love in the misty hills of Kodaikanal
                    </p>
                    <div class="hero-buttons">
                        <a href="products.html?category=chocolate" class="btn btn-hero btn-hero-primary px-6 py-3 rounded-lg bg-green-600 hover:bg-green-700 transition">Explore Chocolates</a>
                    </div>
                </div>
            </div>
            <!-- Add more slides as needed -->
        </div>

        <!-- Navigation -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
    </div>

    <!-- Include Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const swiper = new Swiper('.hero-swiper', {
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev'
                },
            });
        });
    </script>
</x-app-layout>
