<section class="brand-section">
    <div class="brand-gradient-overlay"></div>

    <div class="brand-container">
        <div style="text-align: center; margin-bottom: 3rem;">
            <h2 class="section-title">
                Our Brands
                <span class="title-underline"></span>
            </h2>
        </div>

        <div class="brand-grid">
            @foreach($brands as $brand)
                <div class="brand-item">
                    <div class="brand-logo-wrapper">
                        <img src="{{ asset('storage/' . $brand->gambar) }}"
                             alt="{{ $brand->nama }}"
                             class="brand-logo">
                        <div class="brand-shadow"></div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>
