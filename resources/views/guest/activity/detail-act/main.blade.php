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