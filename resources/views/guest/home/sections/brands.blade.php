@if(isset($brands) && $brands->count() > 0)
<div class="container-fluid brand-section smooth-section">
    <div class="container">

        <div class="brand-header text-center mb-5">
            <h4>Our Partners & Brands</h4>
            <h1>Trusted Collaborations</h1>
            <p>Kami berkolaborasi dengan berbagai brand terpercaya.</p>
        </div>

        <div class="brand-row">

            @foreach ($brands as $brand)
            <div class="brand-item-wrapper">
                <div class="brand-item">
                    <a href="{{ $brand->url ?? '#' }}" target="_blank">
                        <img src="{{ asset('storage/' . $brand->gambar) }}" 
                             alt="{{ $brand->nama }}"
                             class="brand-logo"
                             onerror="this.src='https://via.placeholder.com/150?text=No+Image';">
                    </a>
                </div>
            </div>
            @endforeach

        </div>

    </div>
</div>
@endif
