<section class="intro-section">
    <div class="intro-container">
        <div class="intro-grid">

            <div class="intro-content">
                <span class="intro-label">{{ $company->company_name ?? 'Umalo Sedia Tekno' }}</span>

                <h2 class="intro-title">
                    <span class="intro-title-highlight">{{ $company->slogan ?? 'Way To Know' }}</span>
                    Transformasi Digital
                </h2>

                <p class="intro-text">
                    {{ $company->short_history ?? 'Umalo adalah penyedia solusi teknologi pendidikan dan integrasi sistem.' }}
                </p>
            </div>

            <div class="intro-visual">
                <div class="intro-image-main">
                    <video autoplay muted loop playsinline preload="metadata"
                        poster="{{ asset('storage/img/kantor-umalo.webp') }}">
                        <source src="{{ asset('storage/videos/umalo_introduction.mp4') }}" type="video/mp4">
                    </video>
                </div>

                <div class="intro-image-badge">
                    <img src="{{ asset('storage/img/kantor-umalo.webp') }}" alt="Kantor Umalo">
                </div>
            </div>

        </div>
    </div>
</section>
