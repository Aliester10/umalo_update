@extends('layouts.guest.master')

@section('content')
<style>
    /* Animations */
    @keyframes fadeInDown {
        from { opacity: 0; transform: translate3d(0, -100%, 0); }
        to { opacity: 1; transform: translate3d(0, 0, 0); }
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translate3d(0, 100%, 0); }
        to { opacity: 1; transform: translate3d(0, 0, 0); }
    }
    @keyframes fadeInLeft {
        from { opacity: 0; transform: translate3d(-100%, 0, 0); }
        to { opacity: 1; transform: translate3d(0, 0, 0); }
    }
    @keyframes fadeInRight {
        from { opacity: 0; transform: translate3d(100%, 0, 0); }
        to { opacity: 1; transform: translate3d(0, 0, 0); }
    }
    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    .animate-fade-in-up { 
        animation: fadeInUp 0.8s ease-out; 
    }
    .animate-fade-in-right { 
        animation: fadeInRight 0.8s ease-out; 
    }
    .fade-in-up { 
        animation: fadeInUp 0.6s ease-out forwards; 
        opacity: 0; 
    }
    
    /* Hero Section */
    .hero-section {
        position: relative;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 450px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    /* Intro Section */
    .intro-section {
        padding: 4rem 0;
        background: transparent;
    }
    
    .intro-container {
        max-width: 80rem;
        margin: 0 auto;
        padding: 0 1rem;
    }
    
    .intro-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 3rem;
        align-items: stretch;
    }
    
    @media (min-width: 1024px) {
        .intro-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    .intro-card {
        background-color: #f0fdf4;
        padding: 2rem;
        border-radius: 1rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(4px);
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    
    .intro-video-wrapper {
        position: relative;
    }
    
    .intro-video {
        width: 100%;
        height: 16rem;
        object-fit: cover;
        border-radius: 0.75rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }
    
    @media (min-width: 1024px) {
        .intro-video {
            height: 100%;
        }
    }
    
    .intro-thumbnail {
        position: absolute;
        bottom: -1.5rem;
        left: -1.5rem;
        width: 7rem;
        height: 5rem;
        border-radius: 0.5rem;
        overflow: hidden;
        border: 2px solid white;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        z-index: 10;
    }
    
    @media (min-width: 768px) {
        .intro-thumbnail {
            width: 8rem;
            height: 6rem;
        }
    }
    
    /* Vision Mission Section */
    .vision-mission-section {
        padding: 2.5rem 0;
        background: transparent;
    }
    
    .vision-mission-container {
        max-width: 64rem;
        margin: 0 auto;
        padding: 0 1rem;
    }
    
    .vision-mission-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.25rem;
    }
    
    @media (min-width: 768px) {
        .vision-mission-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    .vision-mission-card {
        background: white;
        border-radius: 1rem;
        padding: 2rem;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        transition: transform 0.7s ease-in-out;
        position: relative;
        overflow: hidden;
    }
    
    .vision-mission-card:hover {
        transform: scale(1.05);
    }
    
    .vision-bg-circle {
        position: absolute;
        top: -2rem;
        right: -2rem;
        width: 6rem;
        height: 6rem;
        background-color: #dcfce7;
        border-radius: 50%;
        opacity: 0.3;
    }
    
    .mission-bg-circle {
        position: absolute;
        bottom: -2rem;
        left: -2rem;
        width: 6rem;
        height: 6rem;
        background-color: #dcfce7;
        border-radius: 50%;
        opacity: 0.3;
    }
    
    .icon-pulse {
        animation: pulse 2s infinite;
    }
    
    /* Our Brand Section */
    .brand-section {
        position: relative;
        padding-top: 6rem;
        padding-bottom: 5rem;
        overflow: visible;
        background: white;
        z-index: 10;
    }
    
    .brand-gradient-overlay {
        position: absolute;
        top: -4rem;
        left: 0;
        width: 100%;
        height: 4rem;
        z-index: 20;
        pointer-events: none;
        background: linear-gradient(to bottom, rgba(255,255,255,0), rgba(255,255,255,1));
    }
    
    .brand-container {
        position: relative;
        z-index: 30;
        max-width: 72rem;
        margin: 0 auto;
        padding: 0 1rem;
    }
    
    .brand-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 2rem;
        align-items: center;
    }
    
    @media (min-width: 768px) {
        .brand-grid {
            gap: 3rem;
        }
    }
    
    .brand-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 7rem;
        transition: transform 0.5s;
    }
    
    @media (min-width: 768px) {
        .brand-item {
            width: 9rem;
        }
    }
    
    .brand-item:hover {
        transform: scale(1.05);
    }
    
    .brand-logo-wrapper {
        position: relative;
    }
    
    .brand-logo {
        height: 5rem;
        object-fit: contain;
        position: relative;
        z-index: 10;
    }
    
    @media (min-width: 768px) {
        .brand-logo {
            height: 7rem;
        }
    }
    
    .brand-shadow {
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%) translateY(0.75rem);
        width: 5rem;
        height: 0.75rem;
        background: rgba(0,0,0,0.1);
        filter: blur(4px);
        border-radius: 50%;
        z-index: 0;
    }
    
    /* Core Values Section */
    .core-values-section {
        padding: 5rem 0;
        background: linear-gradient(to bottom, white, #f9fafb);
        opacity: 0.95;
        position: relative;
        overflow: hidden;
    }
    
    .core-values-header {
        max-width: 56rem;
        margin: 0 auto;
        padding: 0 1.5rem;
        margin-bottom: 4rem;
    }
    
    .core-values-card {
        background: rgba(255,255,255,0.7);
        backdrop-filter: blur(12px);
        border-radius: 1rem;
        padding: 2rem;
    }
    
    .section-title {
        font-size: 2.25rem;
        font-weight: 800;
        letter-spacing: 0.025em;
        color: #1f2937;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.15);
    }
    
    @media (min-width: 768px) {
        .section-title {
            font-size: 3rem;
        }
    }
    
    .title-underline {
        display: block;
        height: 0.25rem;
        width: 5rem;
        background-color: #16a34a;
        margin: 0.75rem auto 0;
        border-radius: 9999px;
    }
    
    .core-values-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 2rem;
        max-width: 72rem;
        margin: 0 auto;
        padding: 0 1rem;
        position: relative;
        z-index: 10;
    }
    
    .core-value-item {
        width: 100%;
        background: rgba(255,255,255,0.7);
        backdrop-filter: blur(12px);
        border: 1px solid #e5e7eb;
        border-radius: 1rem;
        padding: 1.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        transition: all 0.5s;
        transform: translateY(0);
    }
    
    @media (min-width: 640px) {
        .core-value-item {
            width: calc(50% - 1rem);
        }
    }
    
    @media (min-width: 768px) {
        .core-value-item {
            width: calc(33.333% - 1.5rem);
        }
    }
    
    @media (min-width: 1024px) {
        .core-value-item {
            width: calc(28% - 1.5rem);
        }
    }
    
    .core-value-item:hover {
        background: #16a34a;
        transform: translateY(-0.5rem) scale(1.05);
    }
    
    .value-icon-wrapper {
        background: #dcfce7;
        padding: 1rem;
        border-radius: 50%;
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    
    .core-value-item:hover .value-icon-wrapper {
        background: white;
    }
    
    .value-icon {
        color: #15803d;
        font-size: 1.5rem;
        transition: all 0.3s;
    }
    
    .value-title {
        color: #1e3a8a;
        font-size: 1.125rem;
        font-weight: 600;
        text-align: center;
        margin-bottom: 0.5rem;
        transition: all 0.3s;
    }
    
    .core-value-item:hover .value-title {
        color: white;
    }
    
    .value-desc {
        color: black;
        font-weight: 600;
        font-size: 0.875rem;
        line-height: 1.625;
        text-align: justify;
        transition: all 0.3s;
    }
    
    .core-value-item:hover .value-desc {
        color: rgba(255,255,255,0.9);
    }
    
    /* Our Team Section */
    .team-section {
        background: white;
        padding: 4rem 0;
    }
    
    .team-container {
        max-width: 80rem;
        margin: 0 auto;
        padding: 0 1.5rem;
    }
    
    .team-image {
        width: 100%;
        max-width: 56rem;
        margin: 0 auto 3rem;
        height: auto;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        object-fit: cover;
        display: block;
    }
    
    .team-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 1.5rem;
    }
    
    .team-card {
        width: 100%;
        background: white;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        border-radius: 0.75rem;
        padding: 1.5rem;
        transition: all 0.3s;
        text-align: center;
        transform: translateY(0);
    }
    
    @media (min-width: 640px) {
        .team-card {
            width: calc(50% - 0.75rem);
        }
    }
    
    @media (min-width: 768px) {
        .team-card {
            width: calc(33.333% - 1rem);
        }
    }
    
    @media (min-width: 1024px) {
        .team-card {
            width: calc(20% - 1.2rem);
        }
    }
    
    .team-card:hover {
        background: #dbeafe;
        transform: translateY(-0.25rem);
    }
    
    .team-photo {
        width: 6rem;
        height: 6rem;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid white;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        margin: 0 auto;
        transition: all 0.3s;
        display: block;
    }
    
    .team-card:hover .team-photo {
        transform: scale(1.05);
    }
    
    .team-name {
        color: #1f2937;
        font-size: 1.125rem;
        font-weight: 600;
        margin-top: 1rem;
    }
    
    .team-card:hover .team-name {
        color: #1e3a8a;
    }
    
    .team-position {
        color: #16a34a;
        font-size: 0.875rem;
        font-weight: 500;
        margin-top: 0.25rem;
    }
    
    .team-card:hover .team-position {
        color: #1d4ed8;
    }
    
    .team-desc {
        color: #6b7280;
        font-size: 0.75rem;
        margin-top: 0.5rem;
        line-height: 1.375;
    }
    
    .team-card:hover .team-desc {
        color: #374151;
    }
    
    /* Production Line Section */
    .production-section {
        background: white;
        padding: 4rem 0;
    }
    
    .production-container {
        max-width: 80rem;
        margin: 0 auto;
        padding: 0 1rem;
    }
    
    .production-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 2.5rem;
        max-width: 72rem;
        margin: 0 auto;
    }
    
    .production-step {
        width: 100%;
        max-width: 18rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        transition: all 0.3s;
    }
    
    @media (min-width: 640px) {
        .production-step {
            width: calc(50% - 1.25rem);
        }
    }
    
    @media (min-width: 1024px) {
        .production-step {
            width: auto;
        }
    }
    
    .production-step:hover {
        transform: scale(1.05);
    }
    
    .step-image-wrapper {
        position: relative;
        width: 100%;
        margin-bottom: 1rem;
    }
    
    .step-image {
        width: 100%;
        height: 10rem;
        object-fit: cover;
        border-radius: 0.75rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
    
    .step-number {
        position: absolute;
        top: -1rem;
        left: 50%;
        transform: translateX(-50%);
        z-index: 10;
        width: 2.5rem;
        height: 2.5rem;
        background-color: #16a34a;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.875rem;
        font-weight: 700;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
    
    .step-arrow {
        position: absolute;
        right: -35px;
        top: 100px;
        display: none;
    }
    
    @media (min-width: 768px) {
        .step-arrow {
            display: block;
        }
    }
    
    .step-title {
        color: #1e3a8a;
        font-size: 1.125rem;
        font-weight: 600;
        margin-bottom: 0.25rem;
        text-align: center;
    }
    
    .step-desc {
        color: #4b5563;
        font-size: 0.875rem;
        text-align: center;
        padding: 0 0.5rem;
    }
</style>

<!-- Background wrapper -->
<div style="position: relative; overflow: hidden;">
    <!-- Background Image Blurred -->
    <div style="position: absolute; inset: 0; z-index: -10;">
        <img src="{{ asset('storage/img/about_bground.webp') }}"
             alt="Background Kelas Digital"
             style="width: 100%; height: 100%; object-fit: cover; opacity: 0.4; filter: blur(4px);" />
    </div>

    <!-- Hero Section -->
    <section class="hero-section" style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.6)), url('{{ asset('storage/img/about_bground.webp') }}');">
        <div style="text-align: center; color: white; padding: 0 1rem;">
            <h1 style="font-size: 2.25rem; font-weight: 700; margin-bottom: 1rem;" data-aos="fade-down" data-aos-delay="100">
                {{ __('messages.about_us') }}
            </h1>
            <p style="font-size: 1.125rem;" data-aos="fade-up" data-aos-delay="300">
                {{ __('messages.about_us_slogan') }}
            </p>
        </div>
    </section>

    <!-- Intro Section -->
    <section class="intro-section">
        <div class="intro-container">
            <div class="intro-grid">
                <!-- Kiri: Card teks -->
                <div style="display: flex;">
                    <div class="intro-card animate-fade-in-up">
                        <h2 style="color: #15803d; font-size: 0.875rem; font-weight: 600; text-transform: uppercase; margin-bottom: 0.5rem;">
                            {{ $company->company_name ?? 'Umalo Sedia Tekno' }}
                        </h2>
                        <h3 style="font-size: 1.875rem; font-weight: 700; color: #1f2937; margin-bottom: 1rem;">
                            {{ $company->slogan ?? 'Way To Know' }}
                        </h3>
                        <p style="color: #374151; line-height: 1.625; text-align: justify;">
                            {{ $company->short_history ?? 'Umalo adalah penyedia solusi teknologi pendidikan dan integrasi sistem yang didirikan pada tahun 2023 dengan komitmen mendalam terhadap transformasi digital.' }}
                        </p>
                    </div>
                </div>

                <!-- Kanan: Video -->
                <div class="intro-video-wrapper animate-fade-in-right">
                    <video class="intro-video"
                        autoplay muted loop playsinline preload="metadata"
                        poster="{{ asset('storage/img/kantor-umalo.webp') }}">
                        <source src="{{ asset('storage/videos/umalo_introduction.mp4') }}" type="video/mp4">
                    </video>
                    
                    <div class="intro-thumbnail">
                        <img src="{{ asset('storage/img/kantor-umalo.webp') }}"
                             alt="Kantor Umalo"
                             style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Vision Mission Section -->
    <section class="vision-mission-section">
        <div class="vision-mission-container">
            <div class="vision-mission-grid">
                <!-- VISI -->
                <div class="vision-mission-card" data-aos="fade-up" data-aos-duration="1000">
                    <div class="vision-bg-circle"></div>
                    <div style="position: relative; z-index: 10; display: flex; align-items: center; margin-bottom: 1rem;">
                        <i class="fas fa-eye icon-pulse" style="color: #15803d; font-size: 1.5rem; margin-right: 0.75rem;"></i>
                        <span style="color: #15803d; font-size: 1.5rem; font-weight: 700; letter-spacing: 0.025em;">VISI</span>
                    </div>
                    <p style="color: #1f2937; line-height: 1.625; text-align: justify; position: relative; z-index: 10;">
                        {{ __('messages.vision') ?? $company->visi }}
                    </p>
                </div>

                <!-- MISI -->
                <div class="vision-mission-card" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                    <div class="mission-bg-circle"></div>
                    <div style="position: relative; z-index: 10; display: flex; align-items: center; margin-bottom: 1rem;">
                        <i class="fas fa-bullseye icon-pulse" style="color: #15803d; font-size: 1.5rem; margin-right: 0.75rem;"></i>
                        <span style="color: #15803d; font-size: 1.5rem; font-weight: 700; letter-spacing: 0.025em;">MISI</span>
                    </div>
                    <ul style="list-style-type: disc; padding-left: 1.25rem; position: relative; z-index: 10;">
                        <li style="margin-bottom: 0.5rem;">{{ __('messages.mission_1') ?? $company->misi }}</li>
                        <li>{{ __('messages.mission_2') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Brand Section -->
    <section class="brand-section">
        <div class="brand-gradient-overlay"></div>
        
        <div class="brand-container">
            <div style="text-align: center; margin-bottom: 3rem;" data-aos="fade-up">
                <h2 class="section-title">
                    Our Brands
                    <span class="title-underline"></span>
                </h2>
            </div>

            <div class="brand-grid" data-aos="fade-up" data-aos-delay="200">
                @foreach($brands as $brand)
                    <div class="brand-item">
                        <div class="brand-logo-wrapper">
                            <img src="{{ asset('storage/' . $brand->gambar) }}"
                                 alt="{{ $brand->nama }}"
                                 class="brand-logo" />
                            <div class="brand-shadow"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Core Values Section -->
    <section class="core-values-section">
        <!-- Header -->
        <div class="core-values-header animate-fade-in-up">
            <div class="core-values-card">
                <div style="text-align: center; margin-bottom: 3rem;" data-aos="fade-up">
                    <h2 class="section-title">
                        {{ __('messages.core_values_title') }}
                        <span class="title-underline"></span>
                    </h2>
                </div>
                <p style="color: #374151; line-height: 1.625; text-align: center; font-size: 1rem;">
                    {{ __('messages.core_values_description') }}
                </p>
            </div>
        </div>

        <!-- Core Values Cards -->
        <div class="core-values-grid">
            @foreach ([
                ['icon'=>'far fa-handshake','title'=>__('messages.innovation'),'desc'=>__('messages.innovation_description')],
                ['icon'=>'fa fa-dollar-sign','title'=>__('messages.integrity'),'desc'=>__('messages.integrity_description')],
                ['icon'=>'fa fa-bullseye','title'=>__('messages.customer_focus'),'desc'=>__('messages.customer_focus_description')],
                ['icon'=>'fa fa-headphones','title'=>__('messages.collaboration'),'desc'=>__('messages.collaboration_description')],
                ['icon'=>'fa fa-shield-alt','title'=>__('messages.excellence'),'desc'=>__('messages.excellence_description')],
            ] as $index => $item)
                <div class="core-value-item fade-in-up" style="animation-delay: {{ $index * 0.1 }}s;">
                    <div style="display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                        <div class="value-icon-wrapper">
                            <i class="{{ $item['icon'] }} value-icon"></i>
                        </div>
                    </div>
                    <h4 class="value-title">
                        {{ $item['title'] }}
                    </h4>
                    <p class="value-desc">
                        {{ $item['desc'] }}
                    </p>
                </div>
            @endforeach
        </div>

        <!-- Background Pattern -->
        <div style="position: absolute; inset: 0; background-image: url('{{ asset('/storage/img/bg-pattern-light.svg') }}'); opacity: 0.05; background-repeat: no-repeat; background-position: center; background-size: cover; pointer-events: none;"></div>
    </section>

    <!-- Our Team Section -->
    <section class="team-section">
        <div class="team-container">
            <div class="core-values-header animate-fade-in-up">
                <div class="core-values-card">
                    <div style="text-align: center; margin-bottom: 3rem;" data-aos="fade-up">
                        <h2 class="section-title">
                            {{ __('messages.ourteam_title') }}
                            <span class="title-underline"></span>
                        </h2>
                    </div>
                    <p style="color: #374151; line-height: 1.625; text-align: center; font-size: 1rem;">
                        {{ __('messages.ourteam_desc') }}
                    </p>
                </div>
            </div>

            <img src="{{ asset('storage/img/ourteam/diskusi_team.webp') }}"
                 alt="Foto Seluruh Tim Umalo"
                 class="team-image">

            @php
                $team = [
                    [
                        'name' => 'Wahyu ',
                        'position' => 'Product Designer',
                        'desc' => __('messages.ourteam_designer'),
                        'photo' => asset('storage/img/ourteam/product_designer.webp')
                    ],
                    [
                        'name' => 'Trixie',
                        'position' => 'R&D Specialist',
                        'desc' => __('messages.ourteam_rnd'),
                        'photo' => asset('storage/img/ourteam/rnd_specialist.webp')
                    ],
                    [
                        'name' => 'Paian & Jodi',
                        'position' => 'IOT Specialist',
                        'desc' => __('messages.ourteam_iot'),
                        'photo' => asset('storage/img/ourteam/iot_engineers.webp')
                    ],
                    [
                        'name' => 'Aisyah',
                        'position' => 'Software Engineer',
                        'desc' => __('messages.ourteam_se'),
                        'photo' => asset('storage/img/ourteam/software_engineer.webp')
                    ],
                    [
                        'name' => 'Angle',
                        'position' => 'Head of Marketing',
                        'desc' => __('messages.ourteam_marketing'),
                        'photo' => asset('storage/img/ourteam/marketing.webp')
                    ],
                ];
            @endphp

            <div class="team-grid">
                @foreach ($team as $member)
                    <div class="team-card">
                        <img src="{{ $member['photo'] }}" class="team-photo" alt="{{ $member['name'] }}">
                        <h3 class="team-name">{{ $member['name'] }}</h3>
                        <p class="team-position">{{ $member['position'] }}</p>
                        <p class="team-desc">{{ $member['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Production Line Section -->
    <section class="production-section">
        <div class="production-container">
            <div class="core-values-header animate-fade-in-up">
                <div class="core-values-card">
                    <div style="text-align: center; margin-bottom: 3rem;" data-aos="fade-up">
                        <h2 class="section-title">
                            {{ __('messages.production_line_title') }}
                            <span class="title-underline"></span>
                        </h2>
                    </div>
                    <p style="color: #374151; line-height: 1.625; text-align: center; font-size: 1rem;">
                        {{ __('messages.production_line_desc') }}
                    </p>
                </div>
            </div>

            <div class="production-grid">
                @foreach (range(1, 7) as $i)
                    <div class="production-step">
                        <div class="step-image-wrapper">
                            <img src="{{ asset('storage/img/production/step' . $i . '.webp') }}"
                                 alt="Step {{ $i }}"
                                 class="step-image">
                            <div class="step-number">{{ $i }}</div>
                        </div>

                        <h3 class="step-title">
                            {{ __('messages.production_line_' . $i . '_title') }}
                        </h3>
                        <p class="step-desc">
                            {{ __('messages.production_line_' . $i . '_desc') }}
                        </p>

                        @if ($i < 7)
                            <div class="step-arrow">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     style="height: 1.5rem; width: 1.5rem; color: #22c55e;"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>

</div>
@endsection