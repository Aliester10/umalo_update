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