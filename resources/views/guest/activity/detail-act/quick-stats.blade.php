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