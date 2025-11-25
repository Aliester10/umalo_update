<!-- About Start -->
<div class="container-fluid bg-light about mb-5 smooth-section">
    <div class="container py-5">
        <div class="row g-4 justify-content-center">

            <!-- About Image -->
            <div class="col-xl-6 wow fadeInRight about-image" data-wow-delay="0.2s">
                <div class="bg-white rounded p-2 h-100 overflow-hidden">
                    <img
                        src="{{ $company && $company->about_gambar ? asset('storage/' . $company->about_gambar) : asset('assets/img/default_about2.jpg') }}"
                        class="img-fluid rounded w-100 h-100"
                        style="object-fit: cover;"
                        alt="About Image"
                        loading="lazy"
                        decoding="async">
                </div>
            </div>

            <!-- About Content -->
            <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.2s">
                <div class="about-item-content bg-white rounded p-5 h-100">

                    <h4>{{ $company->slogan ?? 'Way To Know' }}</h4>

                    <h1 class="display-4 mb-4 text-primary">
                        {{ $company->company_name ?? 'Umalo Sedia Tekno' }}
                    </h1>

                    <p>
                        {{ $company->short_history ?? 'PT. Umalo Sedia Tekno adalah penyedia solusi teknologi cerdas yang berfokus pada integrasi sistem dan inovasi.' }}
                    </p>

                    <a class="btn btn-primary btn-sm py-3 px-5 mt-5" href="{{ route('about') }}">
                        {{ __('messages.company_info') }}
                    </a>

                </div>
            </div>

        </div>
    </div>
</div>
<!-- About End -->
