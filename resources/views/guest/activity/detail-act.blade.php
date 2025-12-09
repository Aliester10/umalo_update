@extends('layouts.guest.master')

@section('styles')
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
      integrity="sha512-dymI..." crossorigin="anonymous" referrerpolicy="no-referrer" />

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/swiper/11.0.5/swiper-bundle.min.css" rel="stylesheet" />
@endsection

@section('content')
    @include('guest.activity.detail-act.hero')

    @include('guest.activity.detail-act.quick-stats')

    @include('guest.activity.detail-act.main')

@endsection

@section('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/swiper/11.0.5/swiper-bundle.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Initialize AOS animations
    if (typeof AOS !== "undefined") {
        AOS.init({
            duration: 800,
            easing: "ease-in-out",
            once: true,
            offset: 100,
            delay: 50,
            mirror: false,
        });
    }

    // Initialize Swiper carousel
    if (typeof Swiper !== "undefined") {
        setTimeout(() => {
            try {
                const heroSwiper = new Swiper(".hero-swiper", {
                    loop: true,
                    autoplay: {
                        delay: 5000,
                        disableOnInteraction: false,
                    },
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true,
                        dynamicBullets: true,
                    },
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                    effect: "fade",
                    fadeEffect: {
                        crossFade: true,
                    },
                    speed: 1000,
                });
                console.log("✅ Hero carousel initialized");
            } catch (err) {
                console.error("❌ Error initializing Swiper:", err);
            }
        }, 100);
    }

    // Smooth scroll
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener("click", function (e) {
            const href = this.getAttribute("href");
            if (href === "#" || href === "#login") return;

            e.preventDefault();
            const target = document.querySelector(href);

            if (target) {
                const offset = 100;
                const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - offset;

                window.scrollTo({
                    top: targetPosition,
                    behavior: "smooth",
                });
            }
        });
    });

    console.log("✅ Activity detail page loaded successfully");
    console.log("📅 Current user: karinaamiriti");
    console.log("🕐 Date: 2025-11-14 14:44:02 UTC");
});
</script>
@endsection