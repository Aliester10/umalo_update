@extends('layouts.guest.master3')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- Hero Banner Section - Enhanced Design -->
<section class="hero-banner">
  <div class="hero-background">
    <div class="gradient-orb orb-1"></div>
    <div class="gradient-orb orb-2"></div>
    <div class="gradient-orb orb-3"></div>
    <div class="grid-overlay"></div>
    <div class="floating-shapes">
      <div class="shape shape-1"></div>
      <div class="shape shape-2"></div>
      <div class="shape shape-3"></div>
    </div>
  </div>

  <div class="container-hero">
    <div class="hero-content-wrapper">
      <!-- Breadcrumb -->
      <nav class="breadcrumb-modern" aria-label="breadcrumb">
        <a href="{{ route('home') }}" class="breadcrumb-link">
          <i class="fas fa-home"></i>
          <span class="breadcrumb-text">{{ __('messages.home') }}</span>
        </a>
        <i class="fas fa-chevron-right breadcrumb-divider"></i>
        <span class="breadcrumb-current">{{ __('messages.contact') }}</span>
      </nav>
      
      <!-- Title Section -->
      <div class="hero-text-content">
        <div class="hero-badge">
          <span class="badge-pulse"></span>
          Get In Touch
        </div>
        <h1 class="hero-main-title">
          Let's Start a <span class="highlight-text">Conversation</span>
        </h1>
        <p class="hero-subtitle">
          Have questions or need assistance? We're here to help. Send us a message and our team will respond promptly to address your inquiries.
        </p>
        
        <!-- Quick Contact Info -->
        <div class="hero-quick-info">
          <div class="quick-info-item">
            <i class="fas fa-envelope"></i>
            <span>{{ $company->email ?? 'contact@company.com' }}</span>
          </div>
          <div class="quick-info-item">
            <i class="fas fa-phone"></i>
            <span>{{ $company->no_wa ?? '+1234567890' }}</span>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Wave Divider -->
  <div class="wave-divider">
    <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
      <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="wave-fill"></path>
      <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="wave-fill"></path>
      <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="wave-fill"></path>
    </svg>
  </div>
</section>

<style>
/* ========================================
   ENHANCED HERO BANNER WITH SMOOTH TRANSITIONS
   ======================================== */
:root {
  --primary: #228b22;
  --primary-dark: #1a6b1a;
  --primary-light: #2d9f2d;
  --accent: #207178;
  --text-primary: #111827;
  --text-secondary: #6b7280;
  --text-tertiary: #9ca3af;
  --border: #e5e7eb;
  --bg-white: #ffffff;
  --bg-light: #f8f9fa;
  --gray-200: #e2e8f0;
  --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.08);
  --shadow-md: 0 4px 8px rgba(0, 0, 0, 0.1);
  --shadow-lg: 0 10px 25px rgba(0, 0, 0, 0.15);
  --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  --transition-fast: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Smooth Scrolling */
html {
  scroll-behavior: smooth;
}

/* Animations */
@keyframes float {
  0%, 100% {
    transform: translate(0, 0) rotate(0deg);
  }
  33% {
    transform: translate(30px, -50px) rotate(120deg);
  }
  66% {
    transform: translate(-20px, 20px) rotate(240deg);
  }
}

@keyframes floatSlow {
  0%, 100% {
    transform: translateY(0px);
  }
  50% {
    transform: translateY(-20px);
  }
}

@keyframes pulse {
  0%, 100% {
    opacity: 1;
    transform: scale(1);
  }
  50% {
    opacity: 0.5;
    transform: scale(1.1);
  }
}

@keyframes slideUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes fadeIn {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

@keyframes shapeFloat {
  0%, 100% {
    transform: translate(0, 0) rotate(0deg);
  }
  25% {
    transform: translate(20px, -30px) rotate(90deg);
  }
  50% {
    transform: translate(-15px, -15px) rotate(180deg);
  }
  75% {
    transform: translate(-30px, 20px) rotate(270deg);
  }
}

@keyframes shimmer {
  0% {
    background-position: -1000px 0;
  }
  100% {
    background-position: 1000px 0;
  }
}

/* Hero Banner */
.hero-banner {
  position: relative;
  min-height: 65vh;
  display: flex;
  align-items: center;
  padding: 140px 0 120px;
  background: linear-gradient(180deg, 
    rgba(255, 255, 255, 1) 0%, 
    rgba(248, 249, 250, 0.95) 60%,
    rgba(248, 249, 250, 1) 100%
  );
  overflow: hidden;
}

.hero-background {
  position: absolute;
  inset: 0;
  z-index: 0;
}

.gradient-orb {
  position: absolute;
  border-radius: 50%;
  filter: blur(130px);
  opacity: 0.2;
  animation: float 30s ease-in-out infinite;
  will-change: transform;
}

.orb-1 {
  width: 700px;
  height: 700px;
  background: linear-gradient(135deg, #228b22 0%, #207178 100%);
  top: -300px;
  right: -200px;
}

.orb-2 {
  width: 600px;
  height: 600px;
  background: linear-gradient(135deg, #1a6b1a 0%, #1a5f66 100%);
  bottom: -250px;
  left: -200px;
  animation-delay: -15s;
}

.orb-3 {
  width: 500px;
  height: 500px;
  background: linear-gradient(135deg, #2d9f2d 0%, #228b22 100%);
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  animation-delay: -7s;
  opacity: 0.1;
}

.grid-overlay {
  position: absolute;
  inset: 0;
  background-image: 
    linear-gradient(var(--gray-200) 1px, transparent 1px),
    linear-gradient(90deg, var(--gray-200) 1px, transparent 1px);
  background-size: 80px 80px;
  opacity: 0.2;
  mask-image: linear-gradient(to bottom, 
    rgba(0,0,0,0.8) 0%, 
    rgba(0,0,0,0.5) 60%, 
    rgba(0,0,0,0) 100%
  );
}

/* Floating Shapes */
.floating-shapes {
  position: absolute;
  inset: 0;
  overflow: hidden;
}

.shape {
  position: absolute;
  opacity: 0.08;
  animation: shapeFloat 20s ease-in-out infinite;
}

.shape-1 {
  width: 100px;
  height: 100px;
  background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
  border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
  top: 15%;
  left: 10%;
}

.shape-2 {
  width: 150px;
  height: 150px;
  background: linear-gradient(135deg, var(--accent) 0%, var(--primary) 100%);
  border-radius: 63% 37% 54% 46% / 55% 48% 52% 45%;
  top: 60%;
  right: 15%;
  animation-delay: -10s;
}

.shape-3 {
  width: 80px;
  height: 80px;
  background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary) 100%);
  border-radius: 42% 58% 70% 30% / 45% 45% 55% 55%;
  bottom: 20%;
  left: 60%;
  animation-delay: -5s;
}

/* Wave Divider */
.wave-divider {
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  overflow: hidden;
  line-height: 0;
  z-index: 1;
}

.wave-divider svg {
  position: relative;
  display: block;
  width: calc(100% + 1.3px);
  height: 80px;
}

.wave-fill {
  fill: var(--bg-light);
}

.container-hero {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
  position: relative;
  z-index: 2;
  width: 100%;
}

.hero-content-wrapper {
  max-width: 850px;
  margin: 0 auto;
  text-align: center;
}

/* Breadcrumb - SUPER SPESIFIK UNTUK OVERRIDE SEMUA CSS */
.breadcrumb-modern {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  padding: 12px 24px;
  background: rgba(255, 255, 255, 0.98);
  backdrop-filter: blur(20px);
  -webkit-backdrop-filter: blur(20px);
  border: 1px solid rgba(229, 231, 235, 0.6);
  border-radius: 100px;
  font-size: 14px;
  margin-bottom: 32px;
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
  transition: var(--transition);
  animation: slideUp 0.6s ease;
}

.breadcrumb-modern:hover {
  background: rgba(255, 255, 255, 1);
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
  transform: translateY(-2px);
}

/* PERBAIKAN SUPER SPESIFIK - TEKS HOME HIJAU */
.hero-banner .breadcrumb-modern .breadcrumb-link {
  display: flex !important;
  align-items: center !important;
  gap: 7px !important;
  color: #228b22 !important; /* HIJAU - !important untuk override semua */
  text-decoration: none !important;
  font-weight: 600 !important;
  transition: var(--transition-fast) !important;
}

.hero-banner .breadcrumb-modern .breadcrumb-link span.breadcrumb-text {
  color: #228b22 !important; /* HIJAU - !important untuk override semua */
  font-weight: 600 !important;
  display: inline-block !important;
  opacity: 1 !important;
  visibility: visible !important;
}

.hero-banner .breadcrumb-modern .breadcrumb-link:hover {
  color: #1a6b1a !important; /* Hijau lebih gelap saat hover */
  transform: translateX(-2px);
}

.hero-banner .breadcrumb-modern .breadcrumb-link:hover span.breadcrumb-text {
  color: #1a6b1a !important;
}

.hero-banner .breadcrumb-modern .breadcrumb-link i {
  transition: var(--transition-fast);
  color: #228b22 !important; /* Icon juga hijau */
  font-size: 14px !important;
}

.hero-banner .breadcrumb-modern .breadcrumb-link:hover i {
  transform: scale(1.1);
  color: #1a6b1a !important;
}

.hero-banner .breadcrumb-modern .breadcrumb-divider {
  font-size: 10px !important;
  color: var(--text-tertiary) !important;
}

.hero-banner .breadcrumb-modern .breadcrumb-current {
  color: #228b22 !important; /* Hijau untuk halaman aktif */
  font-weight: 600 !important;
  display: inline-block !important;
  opacity: 1 !important;
  visibility: visible !important;
}

/* Hero Text */
.hero-text-content {
  margin-bottom: 0;
}

.hero-badge {
  display: inline-flex;
  align-items: center;
  gap: 12px;
  padding: 10px 24px;
  background: rgba(34, 139, 34, 0.1);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  border: 1px solid rgba(34, 139, 34, 0.2);
  border-radius: 100px;
  color: var(--primary);
  font-size: 13px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 1.5px;
  margin-bottom: 28px;
  animation: slideUp 0.8s ease;
  transition: var(--transition);
}

.hero-badge:hover {
  background: rgba(34, 139, 34, 0.15);
  border-color: rgba(34, 139, 34, 0.3);
  transform: translateY(-2px);
}

.badge-pulse {
  width: 10px;
  height: 10px;
  background: var(--primary);
  border-radius: 50%;
  animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
  box-shadow: 0 0 0 0 rgba(34, 139, 34, 0.4);
}

.hero-main-title {
  font-family: 'Space Grotesk', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
  font-size: clamp(40px, 7vw, 68px);
  font-weight: 800;
  line-height: 1.15;
  letter-spacing: -0.03em;
  margin-bottom: 24px;
  animation: slideUp 0.8s ease 0.1s backwards;
  color: var(--text-primary);
}

.highlight-text {
  background: linear-gradient(135deg, #228b22 0%, #207178 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  position: relative;
  display: inline-block;
}

.highlight-text::after {
  content: '';
  position: absolute;
  bottom: -5px;
  left: 0;
  width: 100%;
  height: 8px;
  background: linear-gradient(90deg, rgba(34, 139, 34, 0.3) 0%, rgba(32, 113, 120, 0.3) 100%);
  border-radius: 4px;
  z-index: -1;
  animation: shimmer 3s ease-in-out infinite;
  background-size: 200% auto;
}

.hero-subtitle {
  font-size: clamp(16px, 2vw, 19px);
  color: var(--text-secondary);
  line-height: 1.75;
  max-width: 680px;
  margin: 0 auto 36px;
  animation: slideUp 0.8s ease 0.2s backwards;
  font-weight: 400;
}

/* Hero Quick Info */
.hero-quick-info {
  display: flex;
  justify-content: center;
  gap: 32px;
  flex-wrap: wrap;
  animation: slideUp 0.8s ease 0.3s backwards;
}

.quick-info-item {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 12px 20px;
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  border: 1px solid rgba(229, 231, 235, 0.5);
  border-radius: 12px;
  font-size: 14px;
  color: var(--text-secondary);
  font-weight: 500;
  transition: var(--transition);
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
}

.quick-info-item:hover {
  background: rgba(255, 255, 255, 1);
  border-color: var(--primary);
  color: var(--primary);
  box-shadow: 0 4px 16px rgba(34, 139, 34, 0.15);
  transform: translateY(-3px);
}

.quick-info-item i {
  font-size: 16px;
  color: var(--primary);
  transition: var(--transition-fast);
}

.quick-info-item:hover i {
  transform: scale(1.15);
}

/* Smooth Section Transitions */
.container-fluid.contact {
  padding-top: 80px !important;
  margin-top: 0 !important;
  background: var(--bg-light);
  position: relative;
  z-index: 2;
  transition: var(--transition);
}

.container-fluid.contact .container {
  padding-top: 0;
}

/* Add smooth fade-in for sections */
.contact .row {
  animation: fadeIn 1s ease;
}

/* Form Elements Transition */
.form-control, .form-floating, .btn {
  transition: var(--transition) !important;
}

.form-control:focus {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(34, 139, 34, 0.15) !important;
}

.btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 16px rgba(34, 139, 34, 0.25) !important;
}

/* Contact Cards Smooth Hover */
.contact-add-item {
  transition: var(--transition);
}

.contact-add-item:hover {
  transform: translateY(-5px);
}

.contact-add-item .contact-icon {
  transition: var(--transition);
}

.contact-add-item:hover .contact-icon {
  transform: scale(1.1) rotate(5deg);
}

/* Map Smooth Transition */
iframe {
  transition: var(--transition);
  border: 1px solid var(--border);
}

iframe:hover {
  box-shadow: var(--shadow-lg);
  transform: scale(1.01);
}

/* Responsive */
@media (max-width: 768px) {
  .hero-banner {
    padding: 120px 0 100px;
    min-height: 55vh;
  }

  .wave-divider svg {
    height: 60px;
  }

  .hero-content-wrapper {
    max-width: 100%;
  }

  .hero-quick-info {
    gap: 16px;
  }

  .quick-info-item {
    font-size: 13px;
    padding: 10px 16px;
  }

  .shape {
    display: none;
  }
}

@media (max-width: 480px) {
  .hero-banner {
    padding: 100px 0 80px;
    min-height: 50vh;
  }

  .wave-divider svg {
    height: 40px;
  }

  .breadcrumb-modern {
    padding: 10px 18px;
    font-size: 13px;
    margin-bottom: 24px;
  }

  .hero-badge {
    font-size: 11px;
    padding: 8px 18px;
    gap: 8px;
    margin-bottom: 22px;
  }

  .badge-pulse {
    width: 8px;
    height: 8px;
  }

  .hero-main-title {
    margin-bottom: 18px;
  }

  .hero-subtitle {
    margin-bottom: 28px;
  }

  .hero-quick-info {
    flex-direction: column;
    gap: 12px;
  }

  .quick-info-item {
    width: 100%;
    justify-content: center;
  }

  .orb-1 {
    width: 450px;
    height: 450px;
    top: -200px;
  }

  .orb-2 {
    width: 400px;
    height: 400px;
    bottom: -180px;
  }

  .orb-3 {
    width: 350px;
    height: 350px;
  }

  .grid-overlay {
    background-size: 50px 50px;
  }
}

/* Reduced Motion */
@media (prefers-reduced-motion: reduce) {
  *,
  *::before,
  *::after {
    animation-duration: 0.01ms !important;
    transition-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
  }
}

/* Ensure smooth scroll padding for fixed headers */
html {
  scroll-padding-top: 80px;
}

/* Add stagger animation to contact cards */
.contact-add-item {
  opacity: 0;
  animation: slideUp 0.6s ease forwards;
}

.col-md-3:nth-child(1) .contact-add-item {
  animation-delay: 0.1s;
}

.col-md-3:nth-child(2) .contact-add-item {
  animation-delay: 0.2s;
}

.col-md-3:nth-child(3) .contact-add-item {
  animation-delay: 0.3s;
}
</style>

<!-- EXISTING CONTACT SECTION -->
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
                transition: var(--transition);
            }

            .contact-img-inner:hover {
                transform: translate(-50%, -50%) scale(1.05);
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
            
            <div class="col-12 wow fadeInUp" data-wow-delay="0.2s">
                <div class="rounded">
                    <iframe class="rounded w-100" 
                    style="height: 400px;" src="{{ $company->maps_iframe }}" 
                    loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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