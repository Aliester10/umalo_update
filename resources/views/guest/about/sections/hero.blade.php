<section class="hero-section" style="background-image: url('{{ asset('storage/img/kantor.jpg') }}');">

    <!-- Corner decorations -->
    <div class="hero-decoration">
        <div class="corner-line corner-tl-v"></div>
        <div class="corner-line corner-tl-h"></div>
        <div class="corner-line corner-br-v"></div>
        <div class="corner-line corner-br-h"></div>
    </div>

    <!-- Floating Dots -->
    <div class="hero-dots">
        <div class="hero-dot"></div>
        <div class="hero-dot"></div>
        <div class="hero-dot"></div>
        <div class="hero-dot"></div>
    </div>

    <div class="hero-content">
        <div class="hero-badge">
            <i class="fas fa-building"></i>
            WELCOME TO
        </div>

        <h1 class="hero-title">{{ __('messages.about_us') }}</h1>

        <div class="hero-divider">
            <span class="divider-dot"></span>
        </div>

        <p class="hero-subtitle">{{ __('messages.about_us_slogan') }}</p>
    </div>

</section>
