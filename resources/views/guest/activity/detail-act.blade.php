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
<!-- Hero Section - Premium Design -->
<section class="detail-hero-premium" id="detailHero">
    <div class="hero-carousel-wrapper">
        <div class="swiper hero-swiper" id="heroSwiper">
            <div class="swiper-wrapper" id="heroCarousel">
                @if($activity->cover_image)
                    <div class="swiper-slide">
                        <img src="{{ asset($activity->cover_image) }}" alt="{{ $activity->title }}" loading="lazy" />
                    </div>
                @endif
                
                @if($activity->images)
                    <div class="swiper-slide">
                        <img src="{{ asset($activity->images) }}" alt="{{ $activity->title }}" loading="lazy" />
                    </div>
                @endif
                
                @foreach($activity->galleries as $gallery)
                    <div class="swiper-slide">
                        <img src="{{ asset($gallery->image) }}" alt="{{ $activity->title }}" loading="lazy" />
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>

    <div class="hero-gradient-overlay"></div>

    <div class="container">
        <div class="hero-content-wrapper">
            <!-- Back Button -->
            <a href="{{ route('activity') }}" class="btn-back-hero">
                <i class="fas fa-arrow-left"></i>
                <span>{{ __('messages.back') }} ke Activities</span>
            </a>

            <!-- Breadcrumb -->
            <nav class="breadcrumb-modern" data-aos="fade-down">
                <a href="{{ route('home') }}"><i class="fas fa-home"></i></a>
                <i class="fas fa-chevron-right"></i>
                <a href="{{ route('activity') }}">{{ __('messages.company_activity') }}</a>
                <i class="fas fa-chevron-right"></i>
                <span id="breadcrumbTitle">{{ $activity->title }}</span>
            </nav>

            <div class="hero-main-content" data-aos="fade-up">
                <!-- Status Badge - UPDATED: Dinamis dari database -->
                <div class="status-badge-premium {{ $activity->status ?? 'ongoing' }}" id="statusBadgeHero">
                    <span class="status-dot"></span>
                    <span class="status-text">
                        @if(($activity->status ?? '') == 'Selesai')
                            Selesai
                        @elseif(($activity->status ?? '') == 'Coming Soon')
                            Mendatang
                        @else
                            Berlangsung
                        @endif
                    </span>
                </div>

                <!-- Title -->
                <h1 class="hero-title-premium" id="detailTitle">
                    {{ $activity->title }}
                </h1>

                <!-- Subtitle -->
                <p class="hero-subtitle" id="detailSubtitle">
                    {{ Str::limit($activity->description, 150) }}
                </p>

                <!-- Meta Info Grid - UPDATED: Hapus hardcode -->
                <div class="hero-meta-grid">
                    <div class="meta-item-premium">
                        <div class="meta-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="meta-content">
                            <span class="meta-label">Tanggal</span>
                            <span class="meta-value" id="heroDate">
                                @if($activity->start_date && $activity->end_date)
                                    {{ $activity->start_date->format('d M') }} - {{ $activity->end_date->format('d M Y') }}
                                @elseif($activity->date)
                                    {{ $activity->date->format('d M Y') }}
                                @else
                                    -
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="meta-item-premium">
                        <div class="meta-icon">
                              <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="meta-content">
                            <span class="meta-label">Lokasi</span>
                            <span class="meta-value" id="heroLocation">{{ $activity->location ?? '-' }}</span>
                        </div>
                    </div>

                    <div class="meta-item-premium">
                        <div class="meta-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="meta-content">
                            <span class="meta-label">Peserta</span>
                            <span class="meta-value" id="heroParticipants">{{ $activity->participants ?? '-' }}</span>
                        </div>
                    </div>

                    <div class="meta-item-premium">
                        <div class="meta-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="meta-content">
                            <span class="meta-label">Durasi</span>
                            <span class="meta-value" id="heroDuration">{{ $activity->duration ?? '-' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="scroll-indicator" data-aos="fade-up" data-aos-delay="800">
        <span>Scroll untuk jelajahi</span>
        <i class="fas fa-chevron-down"></i>
    </div>
</section>

<!-- Quick Stats Section - UPDATED: Hapus hardcode -->
<section class="quick-stats-section">
    <div class="container">
        <div class="stats-cards-grid" data-aos="fade-up">
            <div class="stat-card-premium">
                <div class="stat-icon-wrapper">
                    <i class="fas fa-tag"></i>
                </div>
                <div class="stat-details">
                    <div class="stat-number" id="statCategory">{{ $activity->category ?? '-' }}</div>
                    <div class="stat-label">Kategori</div>
                </div>
            </div>

            <div class="stat-card-premium">
                <div class="stat-icon-wrapper">
                    <i class="fas fa-info-circle"></i>
                </div>
                <div class="stat-details">
                    <div class="stat-number" id="statStatus">
                        @if(($activity->status ?? '') == 'Selesai')
                            Selesai
                        @elseif(($activity->status ?? '') == 'Coming Soon')
                            Mendatang
                        @else
                            Berlangsung
                        @endif
                    </div>
                    <div class="stat-label">Status</div>
                </div>
            </div>

            <div class="stat-card-premium">
                <div class="stat-icon-wrapper">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div class="stat-details">
                    <div class="stat-number" id="statLocation">
                        {{ $activity->location ? explode(',', $activity->location)[0] : '-' }}
                    </div>
                    <div class="stat-label">Lokasi Utama</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Content Section -->
<section class="main-content-section">
    <div class="container">
        <div class="content-grid-premium">
            <!-- Left Column - Main Content -->
            <div class="content-main">
                <!-- Overview -->
                <div class="content-block" data-aos="fade-up">
                    <div class="block-header">
                        <div class="block-icon">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <h2>Ringkasan Kegiatan</h2>
                    </div>
                    <div class="block-content">
                        <p id="activityOverview" class="overview-text">
                            {{ $activity->description }}
                        </p>
                    </div>
                </div>

                <!-- Photo Gallery -->
                @if($activity->galleries->count() > 0)
                <div class="content-block" data-aos="fade-up">
                    <div class="block-header">
                        <div class="block-icon">
                            <i class="fas fa-images"></i>
                        </div>
                        <h2>Galeri Foto Kegiatan</h2>
                        <span class="photo-count" id="photoCount">{{ $activity->galleries->count() }} Foto</span>
                    </div>
                    <div class="block-content">
                        <div class="photo-gallery-premium" id="photoGallery">
                            @foreach($activity->galleries as $gallery)
                                <a href="{{ asset($gallery->image) }}" 
                                   class="gallery-photo-item" 
                                   data-lightbox="gallery" 
                                   data-title="{{ $activity->title }}">
                                    <img src="{{ asset($gallery->image) }}" 
                                         alt="{{ $activity->title }}" 
                                         loading="lazy" />
                                    <div class="gallery-overlay-hover">
                                        <span class="gallery-photo-caption">{{ $activity->title }}</span>
                                    </div>
                                    <div class="gallery-photo-zoom">
                                        <i class="fas fa-search-plus"></i>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                <!-- Key Highlights -->
                @if($activity->highlights->count() > 0)
                <div class="content-block" data-aos="fade-up">
                    <div class="block-header">
                        <div class="block-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <h2>Highlight Utama</h2>
                    </div>
                    <div class="block-content">
                        <ul class="highlights-list-premium" id="highlightsList">
                            @foreach($activity->highlights as $highlight)
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <span>{{ $highlight->highlight }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                <!-- Schedule & Timeline -->
                @if($activity->schedules->count() > 0)
                <div class="content-block" data-aos="fade-up">
                    <div class="block-header">
                        <div class="block-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <h2>Jadwal Detail</h2>
                    </div>
                    <div class="block-content">
                        <div class="schedule-premium" id="scheduleContent">
                            @foreach($activity->schedules as $schedule)
                                <div class="schedule-day-item">
                                    <div class="schedule-day-title">
                                        <i class="fas fa-calendar-check"></i>
                                        {{ $schedule->day_title }}
                                    </div>
                                    <div class="schedule-day-activities">{{ $schedule->schedule_content }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Right Column - Sidebar -->
            <aside class="content-sidebar">
                <!-- Quick Info Card - UPDATED: Hapus hardcode -->
                <div class="sidebar-card-premium">
                    <div class="card-header-premium">
                        <i class="fas fa-info-circle"></i>
                        <h3>Informasi Cepat</h3>
                    </div>
                    <div class="card-body-premium">
                        <div class="info-list-premium">
                            <div class="info-item-premium">
                                <span class="info-label">Kategori</span>
                                <span class="info-value" id="sidebarCategory">{{ $activity->category ?? '-' }}</span>
                            </div>
                            <div class="info-item-premium">
                                <span class="info-label">Status</span>
                                <span class="info-value badge-status {{ $activity->status ?? 'ongoing' }}" id="sidebarStatus">
                                    @if(($activity->status ?? '') == 'Selesai')
                                        Selesai
                                    @elseif(($activity->status ?? '') == 'Coming Soon')
                                        Mendatang
                                    @else
                                        Berlangsung
                                    @endif
                                </span>
                            </div>
                            <div class="info-item-premium">
                                <span class="info-label">Tanggal</span>
                                <span class="info-value" id="sidebarDate">
                                    @if($activity->start_date && $activity->end_date)
                                        {{ $activity->start_date->format('d M') }} - {{ $activity->end_date->format('d M Y') }}
                                    @elseif($activity->date)
                                        {{ $activity->date->format('d M Y') }}
                                    @else
                                        -
                                    @endif
                                </span>
                            </div>
                            <div class="info-item-premium">
                                <span class="info-label">Lokasi</span>
                                <span class="info-value" id="sidebarLocation">{{ $activity->location ?? '-' }}</span>
                            </div>
                            <div class="info-item-premium">
                                <span class="info-label">Peserta</span>
                                <span class="info-value" id="sidebarParticipants">{{ $activity->participants ?? '-' }}</span>
                            </div>
                            <div class="info-item-premium">
                                <span class="info-label">Durasi</span>
                                <span class="info-value" id="sidebarDuration">{{ $activity->duration ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Office Contact Card -->
                <div class="sidebar-card-premium">
                    <div class="card-header-premium">
                        <i class="fas fa-building"></i>
                        <h3>Informasi Kantor</h3>
                    </div>
                    <div class="card-body-premium">
                        <p class="contact-description">
                            Hubungi kantor kami untuk informasi lebih lanjut mengenai kegiatan
                        </p>
                        <div class="contact-details">
                            <div class="contact-item">
                                <i class="fas fa-envelope"></i>
                                <span id="contactEmail">business@umalo.id</span>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-phone"></i>
                                <span id="contactPhone">+62 812 8165 331</span>
                            </div>
                        </div>
                        <a href="mailto:business@umalo.id" class="btn-contact-full">
                            <i class="fas fa-paper-plane"></i>
                            <span>Kirim Email</span>
                        </a>
                    </div>
                </div>

                <!-- Social Media Card -->
                <div class="sidebar-card-premium">
                    <div class="card-header-premium">
                        <i class="fas fa-share-alt"></i>
                        <h3>Social Media Kami</h3>
                    </div>
                    <div class="card-body-premium">
                        <div class="share-buttons-grid">
                            <a href="https://facebook.com/umalo" target="_blank" class="share-btn-premium facebook" title="Follow Kami di Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://twitter.com/umalo" target="_blank" class="share-btn-premium twitter" title="Follow Kami di Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://linkedin.com/company/umalo" target="_blank" class="share-btn-premium linkedin" title="Follow Kami di LinkedIn">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="https://instagram.com/umalo" target="_blank" class="share-btn-premium instagram" title="Follow Kami di Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="https://youtube.com/umalo" target="_blank" class="share-btn-premium youtube" title="Subscribe YouTube Kami">
                                <i class="fab fa-youtube"></i>
                            </a>
                            <a href="https://tiktok.com/@umalo" target="_blank" class="share-btn-premium tiktok" title="Follow Kami di TikTok">
                                <i class="fab fa-tiktok"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Tags - UPDATED: Perbaikan parsing tags -->
                @php
                    $tags = array_filter(array_map('trim', explode(',', $activity->tags ?? '')));
                @endphp

                @if(count($tags) > 0)
                <div class="sidebar-card-premium">
                    <div class="card-header-premium">
                        <i class="fas fa-tags"></i>
                        <h3>Tag</h3>
                    </div>
                    <div class="card-body-premium">
                        <div class="tags-cloud" id="tagsCloud">
                            @foreach($tags as $tag)
                                <span class="tag-premium">{{ $tag }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </aside>
        </div>
    </div>
</section>
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