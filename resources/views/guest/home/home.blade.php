@extends('layouts.guest.master')

@section('content')

<style>
/*** Spinner Start ***/
#spinner {
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.5s ease-out, visibility 0s linear 0.5s;
    z-index: 99999;
}

#spinner.show {
    transition: opacity 0.5s ease-out, visibility 0s linear 0s;
    visibility: visible;
    opacity: 1;
}
/*** Spinner End ***/

/*** Back to Top Start ***/
.back-to-top {
    position: fixed;
    right: 30px;
    bottom: 30px;
    transition: 0.5s;
    z-index: 99;
}
/*** Back to Top End ***/

/*** CSS Custom Properties - Color & Shadow Definitions ***/
:root {
    --primary: #107c10;
    --primary-dark: #0a5c0a;
    --primary-light: #e8f5e9;
    --dark: #1f2937;
    --gray: #6b7280;
    --light-gray: #f5f5f5;
    --lighter-gray: #fafafa;
    --border: #efefef;
    --border-light: #f0f0f0;
    --white: #ffffff;
    --orange: #ff9900;
    --red: #dc2626;
    --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
}

/*** Global Animations ***/
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

@keyframes glow {
    0%, 100% {
        box-shadow: 0 0 20px rgba(16, 124, 16, 0), 0 8px 16px rgba(0, 0, 0, 0.12);
    }
    50% {
        box-shadow: 0 0 30px rgba(16, 124, 16, 0.3), 0 12px 24px rgba(0, 0, 0, 0.18);
    }
}

@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

@keyframes scaleIn {
    from {
        opacity: 0;
        transform: scale(0.95);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

/*** Button Start ***/
.btn {
    font-weight: 600;
    transition: 0.5s;
}

.btn-square,
.btn-sm-square,
.btn-md-square,
.btn-lg-square,
.btn-xl-square {
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: normal;
}

.btn-square { width: 32px; height: 32px; }
.btn-sm-square { width: 34px; height: 34px; }
.btn-md-square { width: 44px; height: 44px; }
.btn-lg-square { width: 56px; height: 56px; }
.btn-xl-square { width: 66px; height: 66px; }

.btn.btn-primary {
    color: var(--white);
    border: none;
}

.btn.btn-primary:hover {
    background: var(--dark);
    color: var(--white);
}

.btn.btn-light {
    color: var(--primary);
    border: none;
}

.btn.btn-light:hover {
    color: var(--white);
    background: var(--dark);
}

.btn.btn-dark {
    color: var(--white);
    border: none;
}

.btn.btn-dark:hover {
    color: var(--primary);
    background: var(--light-gray);
}
/*** Button End ***/

/*** Carousel Hero Header Start - FULLSCREEN FIX ***/
.header-carousel {
    position: relative;
    background: transparent !important;
    margin: 0;
    padding: 0;
    overflow: hidden;
    width: 100%;
    height: 100vh !important;
}

.header-carousel .owl-stage-outer {
    overflow: hidden;
    width: 100%;
    height: 100vh !important;
}

.header-carousel .owl-stage {
    display: flex !important;
    height: 100vh !important;
}

.header-carousel .owl-item {
    height: 100vh !important;
    background: transparent !important;
    opacity: 1 !important;
}

.header-carousel .header-carousel-item {
    position: relative;
    width: 100%;
    height: 100vh !important;   /* FULL SCREEN */
    overflow: hidden;
    background-size: cover !important;
    background-position: center !important;
    background-repeat: no-repeat !important;
    opacity: 1 !important;
    visibility: visible !important;
}

/* Remove overlays */
.header-carousel .header-carousel-item::before,
.header-carousel .header-carousel-item::after {
    display: none !important;
}

/* Caption */
.header-carousel .header-carousel-item .carousel-caption {
    position: absolute;
    left: 60px;
    bottom: 120px;
    max-width: 700px;
    background: rgba(0, 0, 0, 0.55);
    padding: 40px;
    border-radius: 16px;
    backdrop-filter: blur(8px);
    z-index: 10;
    animation: fadeInUp 0.8s ease;
}

.header-carousel .header-carousel-item .carousel-caption h4 {
    color: #ffffff;
    margin-bottom: 15px;
    font-size: 20px;
    font-weight: 700;
}

.header-carousel .header-carousel-item .carousel-caption h1 {
    color: #ffffff;
    margin-bottom: 20px;
    font-weight: 700;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
}

.header-carousel .header-carousel-item .carousel-caption p {
    color: #f0f0f0;
    margin-bottom: 25px;
    font-size: 16px;
}

/* Navigation Arrows */
.header-carousel .owl-nav .owl-prev,
.header-carousel .owl-nav .owl-next {
    position: absolute;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.85);
    color: var(--primary);
    font-size: 26px;
    display: flex;
    align-items: center;
    justify-content: center;
    top: 50%;
    transform: translateY(-50%);
    transition: 0.2s ease;
    z-index: 999;
}

.header-carousel .owl-nav .owl-prev:hover,
.header-carousel .owl-nav .owl-next:hover {
    background: var(--primary);
    color: #fff;
}

.header-carousel .owl-nav .owl-prev {
    left: 30px;
}

.header-carousel .owl-nav .owl-next {
    right: 30px;
}

/* Dots */
.header-carousel .owl-dots {
    position: absolute;
    bottom: 40px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 10px;
    z-index: 999;
}

.header-carousel .owl-dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.5);
    transition: all 0.3s ease;
}

.header-carousel .owl-dot.active {
    width: 30px;
    border-radius: 6px;
    background: #ffffff;
}

/* Hide nav/dots if only 1 slide */
.header-carousel.single-slide .owl-nav,
.header-carousel.single-slide .owl-dots {
    display: none !important;
}

/*** RESPONSIVE ***/
@media (max-width: 991px) {
    .header-carousel .header-carousel-item .carousel-caption {
        left: 30px;
        bottom: 100px;
        max-width: 90%;
        padding: 30px;
    }
}

@media (max-width: 767px) {
    .header-carousel,
    .header-carousel .header-carousel-item,
    .header-carousel .owl-stage-outer,
    .header-carousel .owl-stage,
    .header-carousel .owl-item {
        height: 100vh !important;
    }

    .header-carousel .header-carousel-item .carousel-caption {
        left: 20px;
        right: 20px;
        bottom: 80px;
        max-width: 100%;
        padding: 22px;
    }

    .header-carousel .header-carousel-item .carousel-caption h1 {
        font-size: 28px;
    }

    .header-carousel .owl-nav .owl-prev,
    .header-carousel .owl-nav .owl-next {
        width: 45px;
        height: 45px;
        font-size: 20px;
    }
}

@media (max-width: 576px) {
    .header-carousel .header-carousel-item .carousel-caption {
        left: 15px;
        right: 15px;
        bottom: 60px;
        padding: 16px;
    }

    .header-carousel .header-carousel-item .carousel-caption h1 {
        font-size: 22px;
    }

    .header-carousel .header-carousel-item .carousel-caption h4 {
        font-size: 14px;
    }

    .header-carousel .header-carousel-item .carousel-caption p {
        font-size: 13px;
    }

    .header-carousel .owl-nav {
        display: none !important;
    }
}
/*** Carousel Hero Header End ***/


/*** Service Start ***/
.service-item img {
    width: 100%;
    height: 250px;
    object-fit: cover;
}

.service .service-item {
    border-radius: 10px;
}

.service .service-item .service-img {
    position: relative;
    overflow: hidden;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}

.service .service-item .service-img img {
    transition: 0.5s;
}

.service .service-item:hover .service-img img {
    transform: scale(1.1);
}

.service .service-item .service-img::after {
    content: "";
    position: absolute;
    width: 100%;
    height: 0;
    top: 0;
    left: 0;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    background: rgba(16, 124, 16, 0.2);
    transition: 0.5s;
    z-index: 1;
}

.service .service-item:hover .service-img::after {
    height: 100%;
}

.service .service-item .service-img .service-icon {
    position: absolute;
    width: 70px;
    bottom: 0;
    right: 25px;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    background: var(--light-gray);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: 0.5s;
    z-index: 9;
}

.service .service-item .service-img .service-icon i {
    color: var(--primary);
    transition: 0.5s;
}

.service .service-item:hover .service-img .service-icon i {
    transform: rotateX(360deg);
    color: var(--white);
}

.service .service-item:hover .service-img .service-icon {
    bottom: 0;
    color: var(--white);
    background: var(--primary);
}

.service .service-content {
    position: relative;
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
    background: var(--light-gray);
}

.service .service-item .service-content .service-content-inner {
    position: relative;
    z-index: 9;
}

.service .service-item .service-content .service-content-inner .h4,
.service .service-item .service-content .service-content-inner p {
    transition: 0.5s;
}

.service .service-item:hover .service-content .service-content-inner .h4,
.service .service-item:hover .service-content .service-content-inner p {
    color: var(--white);
}

.service .service-item .service-content::after {
    content: "";
    position: absolute;
    width: 100%;
    height: 0;
    bottom: 0;
    left: 0;
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
    background: var(--primary);
    transition: 0.5s;
    z-index: 1;
}

.service .service-item:hover .service-content::after {
    height: 100%;
}
/*** Service End ***/

/*** Contact Start ***/
.contact-img {
    position: relative;
    height: 100%;
}

.contact-img-inner {
    position: absolute;
    top: 80%;
    left: 50%;
    transform: translate(-50%, -50%);
    max-width: 100%;
}

.contact .contact-img .contact-img-inner {
    position: relative;
    z-index: 9;
}

@media (max-width: 768px) {
    .contact-img-inner {
        top: 50%;
        max-width: 100%;
    }
}
/*** Contact End ***/

/*** Products Section Start ***/
.products-section {
    background: var(--lighter-gray);
    padding: 40px 0;
}

.products-header {
    text-align: center;
    margin-bottom: 40px;
}

.products-header h4 {
    color: var(--primary);
    font-size: 14px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    margin-bottom: 12px;
}

.products-header h1 {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--dark);
    margin-bottom: 20px;
}

.products-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    margin-bottom: 40px;
}

.product-card {
    background: var(--white);
    border: 1px solid var(--border-light);
    border-radius: 8px;
    overflow: hidden;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
    display: flex;
    flex-direction: column;
    position: relative;
    box-shadow: var(--shadow-sm);
    text-decoration: none;
    color: inherit;
}

.product-card:hover {
    box-shadow: var(--shadow-lg);
    transform: translateY(-4px);
    border-color: var(--primary);
}

.product-image-wrapper {
    position: relative;
    width: 100%;
    padding-bottom: 100%;
    overflow: hidden;
    background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
    min-height: 220px;
}

.product-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    background: var(--light-gray);
}

.product-card:hover .product-image {
    transform: scale(1.08);
}

.badge-container {
    position: absolute;
    top: 12px;
    left: 12px;
    display: flex;
    gap: 8px;
    z-index: 2;
}

.discount-badge {
    background: var(--red);
    color: white;
    padding: 6px 10px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: 800;
    box-shadow: 0 2px 4px rgba(220, 38, 38, 0.3);
    text-transform: uppercase;
    letter-spacing: 0.3px;
}

.featured-badge {
    background: var(--orange);
    color: white;
    padding: 6px 10px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: 700;
    box-shadow: 0 2px 4px rgba(255, 153, 0, 0.3);
    text-transform: uppercase;
    letter-spacing: 0.3px;
}

.logo-badge {
    position: absolute;
    bottom: 12px;
    right: 12px;
    width: 52px;
    height: 52px;
    background: var(--white);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    opacity: 0;
    transform: scale(0.7);
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    z-index: 3;
    border: 2.5px solid var(--primary);
    backdrop-filter: blur(4px);
}

.logo-badge img {
    width: 36px;
    height: 36px;
    object-fit: contain;
}

.product-card:hover .logo-badge {
    opacity: 1;
    transform: scale(1);
}

.product-info {
    padding: 16px;
    display: flex;
    flex-direction: column;
    flex: 1;
}

.product-title {
    font-size: 13px;
    font-weight: 600;
    color: var(--dark);
    margin-bottom: 12px;
    line-height: 1.35;
    display: -webkit-box;
    line-clamp: 2;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    letter-spacing: -0.2px;
}

.product-divider {
    height: 1px;
    background: var(--border-light);
    margin-bottom: 12px;
}

.product-seller {
    font-size: 11px;
    color: var(--gray);
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 6px;
    font-weight: 500;
}

.product-seller i {
    font-size: 10px;
}

.product-meta {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
    font-size: 11px;
}

.badge-official {
    color: var(--primary);
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 4px;
    text-transform: uppercase;
    letter-spacing: 0.2px;
}

.badge-official i {
    font-size: 9px;
}

.stock-info {
    color: var(--gray);
    font-weight: 500;
    font-size: 10px;
}

.products-footer {
    text-align: center;
}

@media (max-width: 1400px) {
    .products-grid {
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
    }
}

@media (max-width: 1200px) {
    .products-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
    }
}

@media (max-width: 1024px) {
    .products-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 768px) {
    .products-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }

    .products-header h1 {
        font-size: 2rem;
    }

    .product-title {
        font-size: 12px;
    }
}

@media (max-width: 640px) {
    .products-grid {
        grid-template-columns: 1fr;
        gap: 10px;
    }

    .products-header h1 {
        font-size: 1.75rem;
    }

    .product-info {
        padding: 12px;
    }

    .logo-badge {
        width: 44px;
        height: 44px;
    }

    .logo-badge img {
        width: 30px;
        height: 30px;
    }

    .product-image-wrapper {
        min-height: 200px;
    }
}
/*** Products Section End ***/

/*** Brand & Partner Section Start ***/
.brand-section {
    background: linear-gradient(135deg, #f5f5f5 0%, #fafafa 100%);
    padding: 80px 0;
    position: relative;
    overflow: hidden;
}

.brand-section::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: radial-gradient(circle at 20% 50%, rgba(16, 124, 16, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(16, 124, 16, 0.05) 0%, transparent 50%);
    pointer-events: none;
}

.brand-header {
    text-align: center;
    margin-bottom: 60px;
    position: relative;
    z-index: 2;
}

.brand-header h4 {
    color: #107c10;
    font-size: 14px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1.2px;
    margin-bottom: 15px;
    opacity: 0;
    animation: fadeInDown 0.8s ease forwards;
}

.brand-header h1 {
    font-size: 2.8rem;
    font-weight: 800;
    color: #1f2937;
    margin-bottom: 20px;
    background: linear-gradient(135deg, #1f2937 0%, #107c10 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    opacity: 0;
    animation: fadeInUp 0.8s ease 0.2s forwards;
}

.brand-header p {
    color: #6b7280;
    font-size: 1.05rem;
    line-height: 1.8;
    max-width: 600px;
    margin: 0 auto;
    opacity: 0;
    animation: fadeInUp 0.8s ease 0.4s forwards;
}

.brand-row {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    gap: 24px;
}

.brand-item-wrapper {
    perspective: 1000px;
    opacity: 0;
    animation: fadeInUp 0.8s ease forwards;
    position: relative;
}

.brand-item-wrapper:nth-child(1) { animation-delay: 0.5s; }
.brand-item-wrapper:nth-child(2) { animation-delay: 0.6s; }
.brand-item-wrapper:nth-child(3) { animation-delay: 0.7s; }
.brand-item-wrapper:nth-child(4) { animation-delay: 0.8s; }
.brand-item-wrapper:nth-child(5) { animation-delay: 0.9s; }
.brand-item-wrapper:nth-child(6) { animation-delay: 1s; }
.brand-item-wrapper:nth-child(7) { animation-delay: 1.1s; }
.brand-item-wrapper:nth-child(8) { animation-delay: 1.2s; }

.brand-item {
    background: transparent;
    border-radius: 20px;
    padding: 40px 30px;
    box-shadow: none;
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    border: none;
    position: relative;
    min-width: 160px;
    min-height: 160px;
}

.brand-item:hover {
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    transform: translateY(-12px) scale(1.05);
    animation: float 3s ease-in-out infinite;
}

.brand-logo {
    max-height: 140px;
    max-width: 140px;
    object-fit: contain;
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.12)) brightness(1);
    position: relative;
    z-index: 1;
}

.brand-item:hover .brand-logo {
    transform: scale(1.15) rotate(-2deg);
    filter: drop-shadow(0 15px 30px rgba(16, 124, 16, 0.25)) brightness(1.05);
}

.brand-item a {
    display: block;
    width: 100%;
    text-align: center;
    text-decoration: none;
    position: relative;
    z-index: 2;
}

@media (max-width: 1200px) {
    .brand-section { padding: 60px 0; }
    .brand-header h1 { font-size: 2.3rem; }
    .brand-logo { max-height: 120px; max-width: 120px; }
    .brand-item { padding: 30px 20px; min-width: 140px; min-height: 140px; }
}

@media (max-width: 768px) {
    .brand-section { padding: 50px 0; }
    .brand-header h1 { font-size: 2rem; }
    .brand-header p { font-size: 0.95rem; }
    .brand-item { padding: 25px 15px; min-width: 120px; min-height: 120px; }
    .brand-logo { max-height: 100px; max-width: 100px; }
    .brand-row { gap: 16px; }
}

@media (max-width: 576px) {
    .brand-section { padding: 40px 0; }
    .brand-header h1 { font-size: 1.5rem; }
    .brand-header h4 { font-size: 12px; }
    .brand-header p { font-size: 0.9rem; }
    .brand-item { padding: 20px 10px; min-width: 100px; min-height: 100px; }
    .brand-logo { max-height: 80px; max-width: 80px; }
    .brand-row { gap: 12px; }
}
/*** Brand & Partner Section End ***/

/*** Utility Classes ***/
@media (max-width: 768px) {
    .larger-mobile {
        width: 95% !important;
        margin: 0 auto;
        padding: 20px;
    }

    .btn-switch-auth {
        min-width: 200px !important;
        margin: 0 auto;
        display: flex;
        justify-content: center;
        align-items: center;
    }
}
</style>

 <!-- Carousel Start -->
        <div class="header-carousel owl-carousel">
            @if ($sliders->isEmpty())
                <div class="header-carousel-item bg-primary" style="background-image: url('{{ asset('assets/img/default_about.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                    <div class="carousel-caption text-start"> <!-- Added text-center here -->
                        <div class="container">
                            <div class="row g-4 align-items-center justify-content-center"> <!-- Added justify-content-center -->
                                <div class="col-lg-12 animated fadeInLeft">
                                    <div class="text-start"> <!-- Changed to text-center -->
                                        <h4 class="text-white text-uppercase fw-bold mb-4">{{ __('messages.welcome') }}</h4>
                                        <h1 class="display-1 text-white mb-4">{{ __('messages.slogan') }}</h1>
                                        <div class="d-flex justify-content-start flex-shrink-0 mb-4 mt-5"> <!-- Centered buttons -->
                                            <a class="btn btn-light rounded-pill py-3 px-4 px-md-5 ms-2" href="{{ route('about') }}">{{ __('messages.explore_services') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                @foreach ($sliders as $slider)
                    <div class="header-carousel-item bg-primary" style="background-image: url('{{ asset($slider->image_url) }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                        <div class="carousel-caption text-start"> <!-- Added text-center here -->
                            <div class="container">
                                <div class="row g-4 align-items-center justify-content-center"> <!-- Added justify-content-center -->
                                    <div class="col-lg-12 animated fadeInLeft">
                                        <div class="text-start"> <!-- Changed to text-center -->
                                            <h4 class="text-white text-uppercase fw-bold">{{ $slider->subtitle }}</h4>
                                            <h1 class="display-1 text-white">{{ $slider->title }}</h1>
                                            <p class="fs-5">{{ $slider->description }}</p>
                                            <div class="d-flex justify-content-start flex-shrink-0"> <!-- Centered buttons -->
                                                <a class="btn btn-light rounded-pill py-3 px-4 px-md-5 ms-2" href="{{ $slider->button_url }}">{{ $slider->button_text }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <!-- Carousel End -->

<!-- About Start -->
<div class="container-fluid bg-light about mb-5 smooth-section">
    <div class="container py-5">
        <div class="row g-4 justify-content-center">
            <div class="col-xl-6 wow fadeInRight about-image" data-wow-delay="0.2s" order-xl-2>
                <div class="bg-white rounded p-2 h-100 overflow-hidden">
                    <img src="{{ $company && $company->about_gambar ? asset('storage/' . $company->about_gambar) : asset('assets/img/default_about2.jpg') }}" 
                         class="img-fluid rounded w-100 h-100" 
                         style="object-fit: cover;" 
                         alt="About Image">
                </div>
            </div>

            <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.2s" order-xl-1>
                <div class="about-item-content bg-white rounded p-5 h-100">
                    <h4>{{ $company->slogan ?? 'Way To Know' }}</h4>
                    <h1 class="display-4 mb-4 text-primary">{{ $company->compay_name ?? 'Umalo Sedia Tekno' }}</h1>
                    <p>{{ $company->short_history ?? 'PT. Umalo Sedia Tekno is an industry leader in providing innovative IT solutions and smart technology systems. Established in 2023, we specialize in integrating cutting-edge technologies to streamline operations, enhance security, and foster innovation across various industries. Our commitment to excellence and innovation has positioned us at the forefront of the smart technology revolution' }}</p>
                    <a class="btn btn-primary btn-sm py-3 px-5 mt-5" href="{{ route('about') }}">{{ __('messages.company_info') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->

<!-- Products Start -->
@if (!$products->isEmpty())
<div class="products-section smooth-section">
    <div class="container">
        <div class="products-header wow fadeInUp" data-wow-delay="0.2s">
            <h4>{{ __('messages.our_products') }}</h4>
            <h1>{{ __('messages.best_products') }}</h1>
        </div>

        <div class="products-grid">
            @foreach ($products as $product)
                <a href="{{ route('product.show', $product->slug) }}" class="product-card wow fadeInUp" data-wow-delay="0.2s">
                    <div class="product-image-wrapper">
                        <img 
                            src="{{ asset($product->images->first()->images ?? 'https://via.placeholder.com/300x200?text=Product') }}" 
                            class="product-image" 
                            alt="{{ $product->name }}"
                            onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 500 500%22%3E%3Crect fill=%22%23f3f4f6%22 width=%22500%22 height=%22500%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22 dy=%22.3em%22 font-family=%22system-ui%22 font-size=%2248%22 fill=%22%236b7280%22%3E📷%3C/text%3E%3C/svg%3E';"
                        >

                        <div class="badge-container">
                            @if($product->discount)
                                <span class="discount-badge">-{{ $product->discount }}%</span>
                            @endif
                            @if($product->is_featured)
                                <span class="featured-badge">{{ $product->featured_label ?? 'Unggulan' }}</span>
                            @endif
                        </div>

                        <div class="logo-badge">
                            <img src="{{ asset($company->logo ?? 'assets/img/logo.png') }}" alt="Logo">
                        </div>
                    </div>

                    <div class="product-info">
                        <h5 class="product-title">{{ $product->name }}</h5>
                        <div class="product-divider"></div>
                        <p class="product-seller">
                            <i class="fas fa-store"></i>
                            {{ $company->compay_name ?? 'Official Store' }}
                        </p>
                        <div class="product-meta">
                            <span class="badge-official">
                                <i class="fas fa-check-circle"></i> Official
                            </span>
                            <span class="stock-info">
                                Stok: {{ rand(5, 50) }}
                            </span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="products-footer wow fadeInUp" data-wow-delay="0.2s">
            <a class="btn btn-primary btn-sm py-3 px-5" href="{{ route('product.index') }}">
                {{ __('messages.more_products') }}
            </a>
        </div>
    </div>
</div>
@endif
<!-- Products End -->

<!-- Service Start -->
<div class="container-fluid service py-5 mb-5 smooth-section">
    <div class="container py-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
            <h4 class="text-primary">{{ __('messages.services_subtitle') }}</h4>
            <h1 class="display-4 mb-4">{{ __('messages.services_title') }}</h1>
            <p class="mb-0">{{ __('messages.services_description') }}</p>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.2s">
                <div class="service-item">
                    <div class="service-img">
                        <img src="{{ asset('assets/img/iot.jpg') }}" class="img-fluid rounded-top w-100" alt="IoT Integration">
                        <div class="service-icon p-3">
                            <i class="fa fa-network-wired fa-2x"></i>
                        </div>
                    </div>
                    <div class="service-content p-4">
                        <div class="service-content-inner">
                            <a href="#" class="d-inline-block h4 mb-4">{{ __('messages.iot_integration') }}</a>
                            <p class="mb-4">{{ __('messages.iot_description') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.4s">
                <div class="service-item">
                    <div class="service-img">
                        <img src="{{ asset('assets/img/ai.png') }}" class="img-fluid rounded-top w-100" alt="AI Solutions">
                        <div class="service-icon p-3">
                            <i class="fa fa-robot fa-2x"></i>
                        </div>
                    </div>
                    <div class="service-content p-4">
                        <div class="service-content-inner">
                            <a href="#" class="d-inline-block h4 mb-4">{{ __('messages.ai_solutions') }}</a>
                            <p class="mb-4">{{ __('messages.ai_description') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.6s">
                <div class="service-item">
                    <div class="service-img">
                        <img src="{{ asset('assets/img/cyber.png') }}" class="img-fluid rounded-top w-100" alt="Cybersecurity">
                        <div class="service-icon p-3">
                            <i class="fa fa-lock fa-2x"></i>
                        </div>
                    </div>
                    <div class="service-content p-4">
                        <div class="service-content-inner">
                            <a href="#" class="d-inline-block h4 mb-4">{{ __('messages.cybersecurity') }}</a>
                            <p class="mb-4">{{ __('messages.cybersecurity_description') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.8s">
                <div class="service-item">
                    <div class="service-img position-relative">
                        <span class="badge bg-primary text-white position-absolute" style="top: 10px; left: 10px; z-index: 1;">{{ __('messages.most_popular') }}</span>
                        <img src="{{ asset('assets/img/labor.jpg') }}" class="img-fluid rounded-top w-100" alt="Labor Simulator">
                        <div class="service-icon p-3">
                            <i class="fa fa-microscope fa-2x"></i>
                        </div>
                    </div>
                    <div class="service-content p-4">
                        <div class="service-content-inner">
                            <a href="#" class="d-inline-block h4 mb-4">{{ __('messages.labor_simulator') }}</a>
                            <p class="mb-4">{{ __('messages.labor_description') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-4 justify-content-center mt-3">
            <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.8s">
                <div class="service-item">
                    <div class="service-img">
                        <img src="{{ asset('assets/img/smart.jpg') }}" class="img-fluid rounded-top w-100" alt="Smart Automation">
                        <div class="service-icon p-3">
                            <i class="fa fa-cogs fa-2x"></i>
                        </div>
                    </div>
                    <div class="service-content p-4">
                        <div class="service-content-inner">
                            <a href="#" class="d-inline-block h4 mb-4">{{ __('messages.smart_automation') }}</a>
                            <p class="mb-4">{{ __('messages.smart_automation_description') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.8s">
                <div class="service-item">
                    <div class="service-img">
                        <img src="{{ asset('assets/img/smart2.jpg') }}" class="img-fluid rounded-top w-100" alt="Smart IT Solutions">
                        <div class="service-icon p-3">
                            <i class="fa fa-desktop fa-2x"></i>
                        </div>
                    </div>
                    <div class="service-content p-4">
                        <div class="service-content-inner">
                            <a href="#" class="d-inline-block h4 mb-4">{{ __('messages.smart_it_solutions') }}</a>
                            <p class="mb-4">{{ __('messages.smart_it_description') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Service End -->

<!-- Brand & Partner Start -->
@if(isset($brands) && $brands->count() > 0)
<div class="container-fluid brand-section smooth-section">
    <div class="container" style="position: relative; z-index: 2;">
        <div class="brand-header">
            <h4>Our Partners & Brands</h4>
            <h1>Trusted Collaborations</h1>
            <p class="mb-0">Kami berkolaborasi dengan berbagai mitra dan brand terpercaya dalam membangun solusi teknologi inovatif.</p>
        </div>

        <div class="brand-row">
            @foreach ($brands as $brand)
                <div class="brand-item-wrapper">
                    <div class="brand-item">
                        <a href="{{ $brand->url ?? '#' }}" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('storage/' . $brand->gambar) }}" 
                                 alt="{{ $brand->nama ?? 'Brand Logo' }}" 
                                 class="brand-logo"
                                 onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22%3E%3Crect fill=%22%23f3f4f6%22 width=%22100%22 height=%22100%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22 dy=%22.3em%22 font-family=%22system-ui%22 font-size=%2214%22 fill=%22%236b7280%22%3E🏢%3C/text%3E%3C/svg%3E';">
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif
<!-- Brand & Partner End -->

<!-- Contact Start -->
<div class="container-fluid contact bg-light py-5 smooth-section">
    <div class="container py-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
            <h4 class="text-primary">{{ __('messages.contact') }}</h4>
            <h1 class="display-4 mb-4">{{ __('messages.comments_apply') }}</h1>
        </div>
        <div class="row g-5">
            <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.2s">
                <div class="contact-img d-flex justify-content-center">
                    <div class="contact-img-inner">
                        <img src="{{ asset($company->logo ?? 'assets/img/logo.png') }}" class="img-fluid" alt="Contact Image">
                    </div>
                </div>
            </div>

            <div class="col-xl-6 wow fadeInRight" data-wow-delay="0.4s">
                <div>
                    <h4 class="text-primary">{{ __('messages.send_message_title') }}</h4>
                    <p class="mb-4">{{ __('messages.send_message_description') }}</p>
                    
                    <form method="POST" action="{{ route('contact.store') }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-lg-12 col-xl-6">
                                <div class="form-floating">
                                    <input type="text" name="name" class="form-control border-0" id="name" placeholder="{{ __('messages.contact_form.your_name') }}" required>
                                    <label for="name">{{ __('messages.contact_form.your_name') }} <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6">
                                <div class="form-floating">
                                    <input type="email" name="email" class="form-control border-0" id="email" placeholder="{{ __('messages.contact_form.your_email') }}" required>
                                    <label for="email">{{ __('messages.contact_form.your_email') }} <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6">
                                <div class="form-floating">
                                    <input type="text" name="phone" class="form-control border-0" id="phone" placeholder="{{ __('messages.contact_form.your_phone') }}"
                                        pattern="[0-9]{8,15}" title="Please enter a valid phone number (8-15 digits)" inputmode="numeric"
                                        minlength="8" maxlength="15" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                    <label for="phone">{{ __('messages.contact_form.your_phone') }}</label>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6">
                                <div class="form-floating">
                                    <input type="text" name="company" class="form-control border-0" id="project" placeholder="{{ __('messages.contact_form.your_company') }}">
                                    <label for="project">{{ __('messages.contact_form.your_company') }}</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" name="subject" class="form-control border-0" id="subject" placeholder="{{ __('messages.contact_form.subject') }}" required>
                                    <label for="subject">{{ __('messages.contact_form.subject') }} <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control border-0" name="message" placeholder="{{ __('messages.contact_form.message') }}" id="message" style="height: 120px" required></textarea>
                                    <label for="message">{{ __('messages.contact_form.message') }} <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3">{{ __('messages.contact_form.send_message') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-3 bg-white p-3 rounded wow fadeInUp mx-2 mt-2" data-wow-delay="0.2s">
                        <div class="contact-add-item">
                            <div class="contact-icon text-primary mb-4">
                                <i class="fas fa-map-marker-alt fa-2x"></i>
                            </div>
                            <div>
                                <h4>{{ __('messages.contact_info.address') }}</h4>
                                <p class="mb-0">{{ $company->address }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 bg-white p-3 rounded wow fadeInUp mx-2 mt-2" data-wow-delay="0.4s">
                        <div class="contact-add-item">
                            <div class="contact-icon text-primary mb-4">
                                <i class="fas fa-envelope fa-2x"></i>
                            </div>
                            <div>
                                <h4>{{ __('messages.contact_info.mail_us') }}</h4>
                                <p class="mb-0">{{ $company->email }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 bg-white p-3 rounded wow fadeInUp mx-2 mt-2" data-wow-delay="0.6s">
                        <div class="contact-add-item">
                            <div class="contact-icon text-primary mb-4">
                                <i class="fa fa-phone-alt fa-2x"></i>
                            </div>
                            <div>
                                <h4>{{ __('messages.contact_info.telephone') }}</h4>
                                <p class="mb-0">{{ $company->no_wa }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->

<!-- Error Modal -->
@if($errors->any())
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border: 2px solid #dc3545;">
            <div class="modal-header" style="background-color: #dc3545; color: #fff;">
                <h5 class="modal-title" id="errorModalLabel">Error</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="filter: invert(1);"></button>
            </div>
            <div class="modal-body" style="background-color: #f8d7da; color: #721c24;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Success Modal -->
@if(session('success'))
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border: 2px solid #107C10;">
            <div class="modal-header" style="color: #107C10;">
                <h5 class="modal-title" id="successModalLabel"><b>Success</b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="filter: invert(1);"></button>
            </div>
            <div class="modal-body" style="background-color: #d4edda; color: #155724;">
                {{ session('success') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endif

<script>
(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($("#spinner").length > 0) {
                $("#spinner").removeClass("show");
            }
        }, 1);
    };
    spinner(0);

    // Initiate the wowjs
    new WOW().init();

    // Sticky Navbar
    $(window).scroll(function () {
        if ($(this).scrollTop() > 45) {
            $(".nav-bar").addClass("sticky-top shadow-sm").css("top", "0px");
        } else {
            $(".nav-bar").removeClass("sticky-top shadow-sm").css("top", "-100px");
        }
    });

   // Header carousel - FIXED selector
var slideCount = $('.header-carousel .header-carousel-item').length;

console.log('Total slides found:', slideCount); // Debug log

$(".header-carousel").owlCarousel({
    items: 1,
    margin: 0,
    stagePadding: 0,
    autoplay: slideCount > 1,
    autoplayTimeout: 5000,
    autoplayHoverPause: true,
    smartSpeed: 800,
    dots: slideCount > 1,
    loop: slideCount > 1,
    rewind: slideCount > 1,
    nav: slideCount > 1,
    navText: [
        '<i class="bi bi-arrow-left"></i>',
        '<i class="bi bi-arrow-right"></i>',
    ],
    lazyLoad: false,
    mouseDrag: slideCount > 1,
    touchDrag: slideCount > 1,
    pullDrag: slideCount > 1,
    freeDrag: false
});

    
    // Add single-slide class if only one slide
    if (slideCount === 1) {
        $('.header-carousel').addClass('single-slide');
        console.log('Single slide mode activated'); // Debug log
    }

    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $(".back-to-top").fadeIn("slow");
        } else {
            $(".back-to-top").fadeOut("slow");
        }
    });

    $(".back-to-top").click(function () {
        $("html, body").animate({ scrollTop: 0 }, 1500, "easeInOutExpo");
        return false;
    });

    // Modal handlers
    document.addEventListener("DOMContentLoaded", function() {
        @if($errors->any())
            var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
            errorModal.show();
        @endif
    
        @if(session('success'))
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        @endif
    });
})(jQuery);
</script>

@endsection