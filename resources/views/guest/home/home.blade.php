@extends('layouts.guest.master')

@section('content')

<!-- Carousel Start -->
<div class="header-carousel owl-carousel">
    @if ($sliders->isEmpty())
        <div class="header-carousel-item bg-primary"
            style="background-image: url('{{ asset('assets/img/default_about.jpg') }}');
                   background-size: cover;
                   background-position: center;
                   background-repeat: no-repeat;
                   height: 100vh;">
            <div class="carousel-caption text-start bg-overlay">
                <div class="container">
                    <div class="row g-4 align-items-center justify-content-center">
                        <div class="col-lg-12 animated fadeInLeft">
                            <div class="text-start">
                                <h4 class="text-white text-uppercase fw-bold mb-4">{{ __('messages.welcome') }}</h4>
                                <h1 class="display-1 text-white mb-4">{{ __('messages.slogan') }}</h1>
                                <div class="d-flex justify-content-start flex-shrink-0 mb-4 mt-5">
                                    <a class="btn btn-light rounded-pill py-3 px-4 px-md-5 ms-2"
                                       href="{{ route('about') }}">{{ __('messages.explore_services') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        @foreach ($sliders as $slider)
            <div class="header-carousel-item"
                style="background-image: url('{{ asset($slider->image_url) }}');
                       background-size: cover;
                       background-position: center;
                       background-repeat: no-repeat;
                       height: 100vh;
                       position: relative;">

                @if ($slider->title || $slider->subtitle || $slider->description || $slider->button_text)
                    <div class="carousel-caption text-start bg-overlay">
                        <div class="container">
                            <div class="row g-4 align-items-center justify-content-center">
                                <div class="col-lg-12 animated fadeInLeft">
                                    <div class="text-start">
                                        @if ($slider->subtitle)
                                            <h4 class="text-white text-uppercase fw-bold">{{ $slider->subtitle }}</h4>
                                        @endif
                                        @if ($slider->title)
                                            <h1 class="display-1 text-white">{{ $slider->title }}</h1>
                                        @endif
                                        @if ($slider->description)
                                            <p class="fs-5">{{ $slider->description }}</p>
                                        @endif
                                        @if ($slider->button_text)
                                            <div class="d-flex justify-content-start flex-shrink-0">
                                                <a class="btn btn-light rounded-pill py-3 px-4 px-md-5 ms-2"
                                                   href="{{ $slider->button_url }}">
                                                   {{ $slider->button_text }}
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @endforeach
    @endif
</div>
<!-- Carousel End -->

<style>
    .header-carousel-item {
        position: relative;
        width: 100%;
        height: 100vh;
    }

    .bg-overlay {
        background: rgba(0, 0, 0, 0.45);
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    .header-carousel .owl-nav .owl-prev,
    .header-carousel .owl-nav .owl-next {
        display: none !important;
    }
</style>


    <!-- About Start -->
    <div class="container-fluid bg-light about mb-5">
        <div class="container py-5">
            <div class="row g-4 justify-content-center">
                <div class="col-xl-6 wow fadeInRight about-image" data-wow-delay="0.2s" order-xl-2>
                    <div class="bg-white rounded p-2 h-100 overflow-hidden">
                        <img src="{{ $company && $company->about_gambar ? asset('storage/' . $company->about_gambar) : asset('assets/img/default_about.jpg') }}" class="img-fluid rounded w-100 h-100" style="object-fit: cover;" alt="About Image">
                    </div>
                </div>

                <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.2s" order-xl-1>
                    <div class="about-item-content bg-white rounded p-5 h-100">
                        <h4>{{ $company->slogan ?? 'Way To Know' }}</h4>
                        <h1 class="display-4 mb-4 text-primary">{{ $company->compay_name ?? 'Umalo Sedia Tekno' }}</h1>
                        <p>{{ $company->short_history ?? 'PT. Umalo Sedia Tekno is an industry leader in providing innovative IT solutions and smart technology systems. Established in 2023, we specialize in integrating cutting-edge technologies to streamline operations, enhance security, and foster innovation across various industries. Our commitment to excellence and innovation has positioned us at the forefront of the smart technology revolution' }}</p>
                        <a class="btn btn-primary btn-sm py-3 px-5 mt-5" href="{{ route('about') }}">{{ __('messages.company_info') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <style>
        @media (max-width: 991px) {
            .about .row {
                flex-direction: column-reverse;
            }
            .about-item-content, .bg-white {
                padding: 20px;
            }
            .about {
                padding: 30px 15px;
            }
        }

        @media (max-width: 767px) {
            .about .row {
                flex-direction: column-reverse;
            }
            .about-item-content h1 {
                font-size: 2.5rem;
            }
            .about-item-content {
                padding: 15px;
            }
            .about-image {
                display: none;
            }
        }

        @media (max-width: 576px) {
            .about .row {
                flex-direction: column-reverse;
            }
            .about-item-content h1 {
                font-size: 2rem;
            }
            .about-item-content p {
                font-size: 1rem;
            }
            .about {
                padding: 20px 10px;
            }
            .about-item-content a.btn {
                padding: 10px 20px;
                font-size: 0.9rem;
            }
        }
    </style>

    <!-- Products Start - NEW TOKOPEDIA STYLE -->
    @if (!$products->isEmpty())
    <style>
        :root {
            --primary: #107c10;
            --primary-dark: #0a5c0a;
            --primary-light: #e8f5e9;
            --dark: #1f2937;
            --gray: #6b7280;
            --light-gray: #f5f5f5;
            --lighter-gray: #fafafa;
            --border: #efefef;
            --border-light: #f0f0f0;
            --white: #ffffff;
            --orange: #ff9900;
            --red: #dc2626;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .products-section {
            background: var(--lighter-gray);
            padding: 40px 0;
        }

        .products-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .products-header h4 {
            color: var(--primary);
            font-size: 14px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 12px;
        }

        .products-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 20px;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 40px;
        }

        .product-card {
            background: var(--white);
            border: 1px solid var(--border-light);
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            display: flex;
            flex-direction: column;
            position: relative;
            box-shadow: var(--shadow-sm);
            text-decoration: none;
            color: inherit;
        }

        .product-card:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-4px);
            border-color: var(--primary);
        }

        .product-image-wrapper {
            position: relative;
            width: 100%;
            padding-bottom: 100%;
            overflow: hidden;
            background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
            min-height: 220px;
        }

        .product-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            background: var(--light-gray);
        }

        .product-card:hover .product-image {
            transform: scale(1.08);
        }

        .badge-container {
            position: absolute;
            top: 12px;
            left: 12px;
            display: flex;
            gap: 8px;
            z-index: 2;
        }

        .discount-badge {
            background: var(--red);
            color: white;
            padding: 6px 10px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 800;
            box-shadow: 0 2px 4px rgba(220, 38, 38, 0.3);
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .featured-badge {
            background: var(--orange);
            color: white;
            padding: 6px 10px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 700;
            box-shadow: 0 2px 4px rgba(255, 153, 0, 0.3);
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .logo-badge {
            position: absolute;
            bottom: 12px;
            right: 12px;
            width: 52px;
            height: 52px;
            background: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            opacity: 0;
            transform: scale(0.7);
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            z-index: 3;
            border: 2.5px solid var(--primary);
            backdrop-filter: blur(4px);
        }

        .logo-badge img {
            width: 36px;
            height: 36px;
            object-fit: contain;
        }

        .product-card:hover .logo-badge {
            opacity: 1;
            transform: scale(1);
        }

        .product-info {
            padding: 16px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .product-title {
            font-size: 13px;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 12px;
            line-height: 1.35;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            letter-spacing: -0.2px;
        }

        .product-divider {
            height: 1px;
            background: var(--border-light);
            margin-bottom: 12px;
        }

        .product-seller {
            font-size: 11px;
            color: var(--gray);
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 500;
        }

        .product-seller i {
            font-size: 10px;
        }

        .product-meta {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            font-size: 11px;
        }

        .badge-official {
            color: var(--primary);
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 4px;
            text-transform: uppercase;
            letter-spacing: 0.2px;
        }

        .badge-official i {
            font-size: 9px;
        }

        .stock-info {
            color: var(--gray);
            font-weight: 500;
            font-size: 10px;
        }

        .products-footer {
            text-align: center;
        }

        /* Responsive */
        @media (max-width: 1400px) {
            .products-grid {
                grid-template-columns: repeat(4, 1fr);
                gap: 14px;
            }
        }

        @media (max-width: 1200px) {
            .products-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 14px;
            }
        }

        @media (max-width: 1024px) {
            .products-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 768px) {
            .products-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }

            .products-header h1 {
                font-size: 2rem;
            }

            .product-title {
                font-size: 12px;
            }
        }

        @media (max-width: 640px) {
            .products-grid {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .products-header h1 {
                font-size: 1.75rem;
            }

            .product-info {
                padding: 12px;
            }

            .logo-badge {
                width: 44px;
                height: 44px;
            }

            .logo-badge img {
                width: 30px;
                height: 30px;
            }

            .product-image-wrapper {
                min-height: 200px;
            }
        }
    </style>

    <div class="products-section">
        <div class="container">
            <div class="products-header wow fadeInUp" data-wow-delay="0.2s">
                <h4>{{ __('messages.our_products') }}</h4>
                <h1>{{ __('messages.best_products') }}</h1>
            </div>

            <div class="products-grid">
                @foreach ($products as $product)
                    <a href="{{ route('product.show', $product->slug) }}" class="product-card wow fadeInUp" data-wow-delay="0.2s">
                        <div class="product-image-wrapper">
                            <img 
                                src="{{ asset($product->images->first()->images ?? 'https://via.placeholder.com/300x200?text=Product') }}" 
                                class="product-image" 
                                alt="{{ $product->name }}"
                                onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 500 500%22%3E%3Crect fill=%22%23f3f4f6%22 width=%22500%22 height=%22500%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22 dy=%22.3em%22 font-family=%22system-ui%22 font-size=%2248%22 fill=%22%236b7280%22%3E📷%3C/text%3E%3C/svg%3E';"
                            >

                            <div class="badge-container">
                                @if($product->discount)
                                    <span class="discount-badge">-{{ $product->discount }}%</span>
                                @endif
                                @if($product->is_featured)
                                    <span class="featured-badge">{{ $product->featured_label ?? 'Unggulan' }}</span>
                                @endif
                            </div>

                            <div class="logo-badge">
                                <img src="{{ asset($company->logo ?? 'assets/img/logo.png') }}" alt="Logo">
                            </div>
                        </div>

                        <div class="product-info">
                            <h5 class="product-title">{{ $product->name }}</h5>
                            <div class="product-divider"></div>
                            <p class="product-seller">
                                <i class="fas fa-store"></i>
                                {{ $company->compay_name ?? 'Official Store' }}
                            </p>
                            <div class="product-meta">
                                <span class="badge-official">
                                    <i class="fas fa-check-circle"></i> Official
                                </span>
                                <span class="stock-info">
                                    Stok: {{ rand(5, 50) }}
                                </span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="products-footer wow fadeInUp" data-wow-delay="0.2s">
                <a class="btn btn-primary btn-sm py-3 px-5" href="{{ route('product.index') }}">
                    {{ __('messages.more_products') }}
                </a>
            </div>
        </div>
    </div>
    @endif
    <!-- Products End -->

    <style>
        .service-item img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }
    </style>

    <!-- Service Start -->
    <div class="container-fluid service py-5 mb-5">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <h4 class="text-primary">{{ __('messages.services_subtitle') }}</h4>
                <h1 class="display-4 mb-4">{{ __('messages.services_title') }}</h1>
                <p class="mb-0">{{ __('messages.services_description') }}</p>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="service-item">
                        <div class="service-img">
                            <img src="{{ asset('assets/img/iot.jpg') }}" class="img-fluid rounded-top w-100" alt="">
                            <div class="service-icon p-3">
                                <i class="fa fa-network-wired fa-2x"></i>
                            </div>
                        </div>
                        <div class="service-content p-4">
                            <div class="service-content-inner">
                                <a href="#" class="d-inline-block h4 mb-4">{{ __('messages.iot_integration') }}</a>
                                <p class="mb-4">{{ __('messages.iot_description') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="service-item">
                        <div class="service-img">
                            <img src="{{ asset('assets/img/ai.png') }}" class="img-fluid rounded-top w-100" alt="">
                            <div class="service-icon p-3">
                                <i class="fa fa-robot fa-2x"></i>
                            </div>
                        </div>
                        <div class="service-content p-4">
                            <div class="service-content-inner">
                                <a href="#" class="d-inline-block h4 mb-4">{{ __('messages.ai_solutions') }}</a>
                                <p class="mb-4">{{ __('messages.ai_description') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.6s">
                    <div class="service-item">
                        <div class="service-img">
                            <img src="{{ asset('assets/img/cyber.png') }}" class="img-fluid rounded-top w-100" alt="">
                            <div class="service-icon p-3">
                                <i class="fa fa-lock fa-2x"></i>
                            </div>
                        </div>
                        <div class="service-content p-4">
                            <div class="service-content-inner">
                                <a href="#" class="d-inline-block h4 mb-4">{{ __('messages.cybersecurity') }}</a>
                                <p class="mb-4">{{ __('messages.cybersecurity_description') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.8s">
                    <div class="service-item">
                        <div class="service-img position-relative">
                            <span class="badge bg-primary text-white position-absolute" style="top: 10px; left: 10px; z-index: 1;">{{ __('messages.most_popular') }}</span>
                            <img src="{{ asset('assets/img/labor.jpg') }}" class="img-fluid rounded-top w-100" alt="">
                            <div class="service-icon p-3">
                                <i class="fa fa-microscope fa-2x"></i>
                            </div>
                        </div>
                        <div class="service-content p-4">
                            <div class="service-content-inner">
                                <a href="#" class="d-inline-block h4 mb-4">{{ __('messages.labor_simulator') }}</a>
                                <p class="mb-4">{{ __('messages.labor_description') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-4 justify-content-center mt-3">
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.8s">
                    <div class="service-item">
                        <div class="service-img">
                            <img src="{{ asset('assets/img/smart.jpg') }}" class="img-fluid rounded-top w-100" alt="">
                            <div class="service-icon p-3">
                                <i class="fa fa-cogs fa-2x"></i>
                            </div>
                        </div>
                        <div class="service-content p-4">
                            <div class="service-content-inner">
                                <a href="#" class="d-inline-block h4 mb-4">{{ __('messages.smart_automation') }}</a>
                                <p class="mb-4">{{ __('messages.smart_automation_description') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.8s">
                    <div class="service-item">
                        <div class="service-img">
                            <img src="{{ asset('assets/img/smart2.jpg') }}" class="img-fluid rounded-top w-100" alt="">
                            <div class="service-icon p-3">
                                <i class="fa fa-desktop fa-2x"></i>
                            </div>
                        </div>
                        <div class="service-content p-4">
                            <div class="service-content-inner">
                                <a href="#" class="d-inline-block h4 mb-4">{{ __('messages.smart_it_solutions') }}</a>
                                <p class="mb-4">{{ __('messages.smart_it_description') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->

    <!-- Contact Start -->
    <div class="container-fluid contact bg-light py-5">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <h4 class="text-primary">{{ __('messages.contact') }}</h4>
                <h1 class="display-4 mb-4">{{ __('messages.comments_apply') }}</h1>
            </div>
            <div class="row g-5">
                <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="contact-img d-flex justify-content-center">
                        <div class="contact-img-inner">
                            <img src="{{ asset($company->logo ?? 'assets/img/logo.png') }}" class="img-fluid" alt="Image">
                        </div>
                    </div>
                </div>

                <style>
                    .contact-img {
                        position: relative;
                        height: 100%;
                    }

                    .contact-img-inner {
                        position: absolute;
                        top: 80%;
                        left: 50%;
                        transform: translate(-50%, -50%);
                        max-width: 100%;
                    }

                    @media (max-width: 768px) {
                        .contact-img-inner {
                            top: 50%;
                            max-width: 100%;
                        }
                    }
                </style>

                <div class="col-xl-6 wow fadeInRight" data-wow-delay="0.4s">
                    <div>
                        <h4 class="text-primary">{{ __('messages.send_message_title') }}</h4>
                        <p class="mb-4">{{ __('messages.send_message_description') }}</p>
                        
                        <form method="POST" action="{{ route('contact.store') }}">
                            @csrf
                            <div class="row g-3">
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <input type="text" name="name" class="form-control border-0" id="name" placeholder="{{ __('messages.contact_form.your_name') }}" required>
                                        <label for="name">{{ __('messages.contact_form.your_name') }} <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <input type="email" name="email" class="form-control border-0" id="email" placeholder="{{ __('messages.contact_form.your_email') }}" required>
                                        <label for="email">{{ __('messages.contact_form.your_email') }} <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <input type="text" name="phone" class="form-control border-0" id="phone" placeholder="{{ __('messages.contact_form.your_phone') }}"
                                            pattern="[0-9]{8,15}" title="Please enter a valid phone number (8-15 digits)" inputmode="numeric"
                                            minlength="8" maxlength="15" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                        <label for="phone">{{ __('messages.contact_form.your_phone') }}</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <input type="text" name="company" class="form-control border-0" id="project" placeholder="{{ __('messages.contact_form.your_company') }}">
                                        <label for="project">{{ __('messages.contact_form.your_company') }}</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" name="subject" class="form-control border-0" id="subject" placeholder="{{ __('messages.contact_form.subject') }}" required>
                                        <label for="subject">{{ __('messages.contact_form.subject') }} <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control border-0" name="message" placeholder="{{ __('messages.contact_form.message') }}" id="message" style="height: 120px" required></textarea>
                                        <label for="message">{{ __('messages.contact_form.message') }} <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3">{{ __('messages.contact_form.send_message') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-3 bg-white p-3 rounded wow fadeInUp mx-2 mt-2" data-wow-delay="0.2s">
                            <div class="contact-add-item">
                                <div class="contact-icon text-primary mb-4">
                                    <i class="fas fa-map-marker-alt fa-2x"></i>
                                </div>
                                <div>
                                    <h4>{{ __('messages.contact_info.address') }}</h4>
                                    <p class="mb-0">{{ $company->address }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 bg-white p-3 rounded wow fadeInUp mx-2 mt-2" data-wow-delay="0.4s">
                            <div class="contact-add-item">
                                <div class="contact-icon text-primary mb-4">
                                    <i class="fas fa-envelope fa-2x"></i>
                                </div>
                                <div>
                                    <h4>{{ __('messages.contact_info.mail_us') }}</h4>
                                    <p class="mb-0">{{ $company->email }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 bg-white p-3 rounded wow fadeInUp mx-2 mt-2" data-wow-delay="0.6s">
                            <div class="contact-add-item">
                                <div class="contact-icon text-primary mb-4">
                                    <i class="fa fa-phone-alt fa-2x"></i>
                                </div>
                                <div>
                                    <h4>{{ __('messages.contact_info.telephone') }}</h4>
                                    <p class="mb-0">{{ $company->no_wa }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

    <!-- Error Modal -->
    @if($errors->any())
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #dc3545;">
                <div class="modal-header" style="background-color: #dc3545; color: #fff;">
                    <h5 class="modal-title" id="errorModalLabel">Error</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="filter: invert(1);"></button>
                </div>
                <div class="modal-body" style="background-color: #f8d7da; color: #721c24;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Success Modal -->
    @if(session('success'))
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #107C10;">
                <div class="modal-header" style="color: #107C10;">
                    <h5 class="modal-title" id="successModalLabel"><b>Success</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="filter: invert(1);"></button>
                </div>
                <div class="modal-body" style="background-color: #d4edda; color: #155724;">
                    {{ session('success') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @if($errors->any())
                var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                errorModal.show();
            @endif
        
            @if(session('success'))
                var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                successModal.show();
            @endif
        });
    </script>

@endsection