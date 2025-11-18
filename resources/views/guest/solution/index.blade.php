@extends('layouts.guest.master3')

@section('title', 'Solutions - Umalo | Innovation That Matters')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/styles_reset.css') }}" />
<link rel="stylesheet" href="{{ asset('css/solution_styles.css') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
@endpush

@section('content')

<style>
    /* ===== CSS VARIABLES ===== */
:root {
  /* Colors */
  --primary: #228b22;
  --primary-dark: #1a6b1a;
  --secondary: #207178;
  --dark: #0f172a;
  --darker: #020617;
  --gray-900: #0f172a;
  --gray-800: #1e293b;
  --gray-700: #334155;
  --gray-600: #475569;
  --gray-500: #64748b;
  --gray-400: #94a3b8;
  --gray-300: #cbd5e1;
  --gray-200: #e2e8f0;
  --gray-100: #f1f5f9;
  --gray-50: #f8fafc;
  --white: #ffffff;

  /* Gradients */
  --gradient-primary: linear-gradient(135deg, #228b22 0%, #207178 100%);
  --gradient-dark: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
  --gradient-overlay: linear-gradient(
    180deg,
    transparent 0%,
    rgba(0, 0, 0, 0.7) 100%
  );

  /* Spacing */
  --container-width: 1320px;
  --section-padding: 120px;

  /* Shadows */
  --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
  --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
  --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
  --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
  --shadow-2xl: 0 25px 50px -12px rgba(0, 0, 0, 0.25);

  /* Border Radius */
  --radius-sm: 8px;
  --radius-md: 12px;
  --radius-lg: 16px;
  --radius-xl: 20px;
  --radius-2xl: 24px;

  /* Transitions */
  --transition-base: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  --transition-smooth: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
}

/* ===== BASE STYLES ===== */
body {
  font-family: "Inter", -apple-system, BlinkMacSystemFont, sans-serif;
  background: var(--white);
  color: var(--gray-900);
  line-height: 1.6;
}

.container {
  max-width: var(--container-width);
  margin: 0 auto;
  padding: 0 32px;
}

/* ===== LOADING SCREEN ===== */
.loading-screen {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(135deg, var(--white) 0%, var(--gray-100) 100%);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 9999;
  transition: opacity 0.5s ease, visibility 0.5s ease;
}

.loading-screen.fade-out {
  opacity: 0;
  visibility: hidden;
}

.loader-content {
  text-align: center;
}

.loader-logo {
  margin-bottom: 32px;
  animation: fadeInUp 0.8s ease;
}

.loader-logo img {
  height: 80px;
  width: auto;
  margin: 0 auto;
  animation: pulse 2s ease-in-out infinite;
}

.loader-spinner {
  margin-bottom: 20px;
}

.spinner {
  width: 50px;
  height: 50px;
  margin: 0 auto;
  border: 4px solid rgba(34, 139, 34, 0.1);
  border-top-color: var(--primary);
  border-radius: 50%;
  animation: spin 1s linear infinite;
}

.loader-text {
  font-size: 16px;
  color: var(--gray-700);
  font-weight: 600;
  animation: fadeIn 1s ease;
}

/* ===== ANIMATIONS ===== */
@keyframes spin {
  to {
    transform: rotate(360deg);
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

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes pulse {
  0%,
  100% {
    opacity: 1;
  }
  50% {
    opacity: 0.5;
  }
}

@keyframes float {
  0%,
  100% {
    transform: translate(0, 0) rotate(0deg);
  }
  33% {
    transform: translate(30px, -50px) rotate(120deg);
  }
  66% {
    transform: translate(-20px, 20px) rotate(240deg);
  }
}

/* ===== HERO SECTION ===== */
.hero {
  position: relative;
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 120px 0 80px;
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
  filter: blur(100px);
  opacity: 0.3;
  animation: float 20s ease-in-out infinite;
}

.orb-1 {
  width: 600px;
  height: 600px;
  background: var(--gradient-primary);
  top: -200px;
  right: -100px;
}

.orb-2 {
  width: 500px;
  height: 500px;
  background: var(--gradient-primary);
  bottom: -150px;
  left: -100px;
  animation-delay: -10s;
}

.grid-overlay {
  position: absolute;
  inset: 0;
  background-image: linear-gradient(var(--gray-200) 1px, transparent 1px),
    linear-gradient(90deg, var(--gray-200) 1px, transparent 1px);
  background-size: 50px 50px;
  opacity: 0.3;
}

.hero-content {
  position: relative;
  z-index: 1;
  text-align: center;
  max-width: 900px;
  margin: 0 auto;
}

.hero-tag {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  padding: 8px 20px;
  background: rgba(34, 139, 34, 0.1);
  border: 1px solid rgba(34, 139, 34, 0.2);
  border-radius: 100px;
  color: var(--primary);
  font-size: 13px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 1px;
  margin-bottom: 32px;
}

.tag-pulse {
  width: 8px;
  height: 8px;
  background: var(--primary);
  border-radius: 50%;
  animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

.hero-heading {
  font-family: "Space Grotesk", sans-serif;
  font-size: clamp(48px, 6vw, 72px);
  font-weight: 700;
  line-height: 1.1;
  letter-spacing: -0.02em;
  color: var(--dark);
  margin-bottom: 28px;
}

.text-gradient {
  background: var(--gradient-primary);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.hero-text {
  font-size: 20px;
  color: var(--gray-600);
  line-height: 1.7;
  margin-bottom: 56px;
  max-width: 700px;
  margin-left: auto;
  margin-right: auto;
}

/* ===== SOLUTIONS SECTION ===== */
.solutions {
  padding: var(--section-padding) 0;
  background: var(--white);
  position: relative;
}

.section-header {
  text-align: center;
  max-width: 800px;
  margin: 0 auto 80px;
}

.section-tag {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 8px 20px;
  background: var(--gray-100);
  border-radius: 100px;
  color: var(--gray-700);
  font-size: 13px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 1px;
  margin-bottom: 24px;
}

.section-tag i {
  color: var(--primary);
}

.section-title {
  font-family: "Space Grotesk", sans-serif;
  font-size: clamp(36px, 5vw, 56px);
  font-weight: 700;
  line-height: 1.2;
  letter-spacing: -0.02em;
  color: var(--dark);
  margin-bottom: 24px;
}

.section-description {
  font-size: 18px;
  color: var(--gray-600);
  line-height: 1.7;
}

.solutions-list {
  display: flex;
  flex-direction: column;
  gap: 120px;
}

.solution {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 80px;
  align-items: center;
}

.solution-reverse {
  direction: rtl;
}

.solution-reverse > * {
  direction: ltr;
}

.solution-visual {
  position: relative;
}

.solution-number {
  position: absolute;
  top: -40px;
  left: -40px;
  width: 120px;
  height: 120px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: var(--white);
  border: 2px solid var(--gray-200);
  border-radius: 50%;
  font-size: 48px;
  font-weight: 800;
  color: var(--gray-200);
  z-index: 2;
}

.solution-image {
  position: relative;
  border-radius: var(--radius-2xl);
  overflow: hidden;
  aspect-ratio: 4/3;
  box-shadow: var(--shadow-2xl);
}

.solution-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.7s cubic-bezier(0.16, 1, 0.3, 1);
}

.solution:hover .solution-image img {
  transform: scale(1.05);
}

.image-gradient {
  position: absolute;
  inset: 0;
  background: var(--gradient-overlay);
  opacity: 0;
  transition: opacity 0.5s ease;
}

.solution:hover .image-gradient {
  opacity: 1;
}

.solution-tag {
  position: absolute;
  bottom: 24px;
  left: 24px;
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 8px 16px;
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(10px);
  border-radius: 100px;
  font-size: 13px;
  font-weight: 600;
  color: var(--gray-700);
  z-index: 2;
}

.solution-tag i {
  color: var(--primary);
}

.solution-info {
  padding: 24px 0;
}

.solution-name {
  font-family: "Space Grotesk", sans-serif;
  font-size: 36px;
  font-weight: 700;
  line-height: 1.2;
  letter-spacing: -0.01em;
  color: var(--dark);
  margin-bottom: 16px;
}

.solution-description {
  font-size: 17px;
  color: var(--gray-600);
  line-height: 1.7;
  margin-bottom: 32px;
}

.solution-features {
  display: flex;
  flex-wrap: wrap;
  gap: 12px;
  margin-bottom: 32px;
}

.feature-tag {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 8px 16px;
  background: var(--gray-100);
  border-radius: 100px;
  font-size: 13px;
  font-weight: 500;
  color: var(--gray-700);
}

.feature-tag i {
  color: var(--primary);
  font-size: 12px;
}

.solution-stats {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 20px;
  margin-bottom: 32px;
}

.stat {
  padding: 20px;
  background: var(--gray-50);
  border-radius: var(--radius-lg);
  border-left: 4px solid var(--primary);
}

.stat strong {
  display: block;
  font-size: 28px;
  font-weight: 800;
  color: var(--primary);
  margin-bottom: 4px;
}

.stat span {
  font-size: 14px;
  color: var(--gray-600);
}

.solution-actions {
  display: flex;
  gap: 12px;
  flex-wrap: wrap;
}

/* ===== BUTTONS ===== */
.btn {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  padding: 14px 28px;
  border-radius: var(--radius-lg);
  font-size: 15px;
  font-weight: 600;
  text-decoration: none;
  border: none;
  cursor: pointer;
  font-family: inherit;
  transition: var(--transition-base);
  white-space: nowrap;
}

.btn-primary {
  background: var(--dark);
  color: var(--white);
  box-shadow: var(--shadow-md);
}

.btn-primary:hover {
  background: var(--gray-900);
  transform: translateY(-2px);
  box-shadow: var(--shadow-xl);
}

.btn-ghost {
  background: transparent;
  color: var(--gray-700);
  border: 2px solid var(--gray-300);
}

.btn-ghost:hover {
  background: var(--gray-50);
  border-color: var(--gray-400);
}

.btn-large {
  padding: 16px 32px;
  font-size: 16px;
}

.btn-white {
  background: var(--white);
  color: var(--dark);
  box-shadow: var(--shadow-lg);
}

.btn-white:hover {
  transform: translateY(-3px);
  box-shadow: var(--shadow-2xl);
}

.btn-outline-white {
  background: transparent;
  color: var(--white);
  border: 2px solid rgba(255, 255, 255, 0.3);
}

.btn-outline-white:hover {
  background: rgba(255, 255, 255, 0.1);
  border-color: rgba(255, 255, 255, 0.6);
}

.btn i {
  transition: transform 0.3s ease;
}

.btn:hover i {
  transform: translateX(3px);
}

/* ===== CTA SECTION ===== */
.cta {
  padding: var(--section-padding) 0;
  background: var(--gray-50);
}

.cta-content {
  position: relative;
  padding: 100px 80px;
  background: var(--gradient-dark);
  border-radius: var(--radius-2xl);
  overflow: hidden;
  text-align: center;
}

.cta-background {
  position: absolute;
  inset: 0;
  z-index: 0;
}

.cta-orb {
  position: absolute;
  width: 500px;
  height: 500px;
  background: var(--gradient-primary);
  border-radius: 50%;
  filter: blur(100px);
  opacity: 0.2;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  animation: float 15s ease-in-out infinite;
}

.cta-text {
  position: relative;
  z-index: 1;
  max-width: 700px;
  margin: 0 auto 40px;
}

.cta-heading {
  font-family: "Space Grotesk", sans-serif;
  font-size: clamp(36px, 5vw, 52px);
  font-weight: 700;
  line-height: 1.2;
  color: var(--white);
  margin-bottom: 20px;
}

.cta-description {
  font-size: 18px;
  color: rgba(255, 255, 255, 0.8);
  line-height: 1.7;
}

.cta-actions {
  position: relative;
  z-index: 1;
  display: flex;
  gap: 16px;
  justify-content: center;
  flex-wrap: wrap;
}

/* ===== MODAL - PERBAIKAN UTAMA ===== */
.modal {
  display: none;
  position: fixed;
  inset: 0;
  z-index: 99999;
  padding: 40px 20px;
  overflow-y: auto;
  align-items: center;
  justify-content: center;
}

.modal.show {
  display: flex !important;
}

.modal-backdrop {
  position: fixed;
  inset: 0;
  background: rgba(0, 0, 0, 0.85);
  backdrop-filter: blur(10px);
  animation: fadeIn 0.3s ease;
  z-index: 1;
}

.modal-container {
  position: relative;
  background: var(--white);
  border-radius: var(--radius-2xl);
  max-width: 900px;
  width: 100%;
  margin: auto;
  box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
  animation: slideUp 0.4s cubic-bezier(0.16, 1, 0.3, 1);
  z-index: 10;
  max-height: 90vh;
  overflow: hidden;
  display: flex;
  flex-direction: column;
}

@keyframes slideUp {
  from {
    opacity: 0;
    transform: translateY(40px) scale(0.95);
  }
  to {
    opacity: 1;
    transform: translateY(0) scale(1);
  }
}

.modal-close {
  position: absolute;
  top: 24px;
  right: 24px;
  width: 48px;
  height: 48px;
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(10px);
  border: none;
  border-radius: 50%;
  color: var(--gray-700);
  font-size: 20px;
  cursor: pointer;
  z-index: 100;
  transition: var(--transition-base);
  box-shadow: var(--shadow-md);
}

.modal-close:hover {
  background: var(--white);
  color: var(--dark);
  transform: rotate(90deg);
}

.modal-hero {
  position: relative;
  height: 400px;
  border-radius: var(--radius-2xl) var(--radius-2xl) 0 0;
  overflow: hidden;
  flex-shrink: 0;
}

.modal-hero img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.modal-hero-overlay {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  padding: 40px;
  background: linear-gradient(to top, rgba(0, 0, 0, 0.9), transparent);
  color: var(--white);
}

.modal-hero-overlay h2 {
  font-size: 32px;
  font-weight: 700;
  margin-bottom: 8px;
}

.modal-hero-overlay p {
  font-size: 16px;
  opacity: 0.9;
}

.modal-content {
  padding: 48px;
  overflow-y: auto;
  flex: 1;
}

.modal-section {
  margin-bottom: 40px;
}

.modal-section:last-of-type {
  margin-bottom: 0;
}

.section-icon {
  width: 48px;
  height: 48px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: var(--gradient-primary);
  border-radius: var(--radius-lg);
  color: var(--white);
  font-size: 20px;
  margin-bottom: 16px;
}

.modal-section h3 {
  font-size: 20px;
  font-weight: 700;
  color: var(--dark);
  margin-bottom: 16px;
}

.modal-section p {
  font-size: 16px;
  color: var(--gray-600);
  line-height: 1.8;
}

.modal-features {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 12px;
}

.modal-feature {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 16px;
  background: var(--gray-50);
  border-radius: var(--radius-lg);
  border: 1px solid var(--gray-200);
  transition: var(--transition-base);
}

.modal-feature:hover {
  background: var(--white);
  border-color: var(--primary);
  transform: translateX(4px);
}

.modal-feature-icon {
  width: 32px;
  height: 32px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: var(--gradient-primary);
  border-radius: 50%;
  color: var(--white);
  font-size: 14px;
  flex-shrink: 0;
}

.modal-feature-text {
  font-size: 14px;
  font-weight: 500;
  color: var(--gray-700);
}

.modal-actions {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 16px;
  padding-top: 40px;
  border-top: 2px solid var(--gray-200);
  margin-top: 40px;
}

/* ===== BACK TO TOP ===== */
.back-to-top {
  position: fixed;
  bottom: 32px;
  right: 32px;
  width: 56px;
  height: 56px;
  background: var(--gradient-primary);
  color: var(--white);
  border: none;
  border-radius: 50%;
  font-size: 20px;
  cursor: pointer;
  opacity: 0;
  visibility: hidden;
  transition: var(--transition-base);
  box-shadow: var(--shadow-xl);
  z-index: 999;
}

.back-to-top.visible {
  opacity: 1;
  visibility: visible;
}

.back-to-top:hover {
  transform: translateY(-6px);
  box-shadow: var(--shadow-2xl);
}

/* ===== RESPONSIVE ===== */
@media (max-width: 1200px) {
  .solution {
    gap: 60px;
  }
}

@media (max-width: 1024px) {
  :root {
    --section-padding: 80px;
  }

  .solution,
  .solution-reverse {
    grid-template-columns: 1fr;
    gap: 40px;
    direction: ltr;
  }

  .solutions-list {
    gap: 80px;
  }

  .modal-features {
    grid-template-columns: 1fr;
  }

  .modal-actions {
    grid-template-columns: 1fr;
  }
}

@media (max-width: 768px) {
  .container {
    padding: 0 20px;
  }

  .hero {
    padding: 100px 0 60px;
  }

  .solution-number {
    width: 80px;
    height: 80px;
    font-size: 32px;
    top: -20px;
    left: -20px;
  }

  .solution-stats {
    grid-template-columns: 1fr;
  }

  .solution-actions {
    flex-direction: column;
  }

  .cta-content {
    padding: 60px 32px;
  }

  .cta-actions {
    flex-direction: column;
  }

  .modal-content {
    padding: 32px 20px;
  }

  .modal-hero {
    height: 300px;
  }
}

@media (max-width: 480px) {
  .hero-heading {
    font-size: 36px;
  }

  .hero-text {
    font-size: 16px;
  }

  .solution-name {
    font-size: 28px;
  }

  .solution-description {
    font-size: 15px;
  }

  .btn {
    width: 100%;
    justify-content: center;
  }

  .back-to-top {
    width: 48px;
    height: 48px;
    bottom: 24px;
    right: 24px;
  }
}

/* ===== FORCE MODAL VISIBILITY - OVERRIDE TERAKHIR ===== */
.modal.show {
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
}

.modal.show .modal-container {
    position: relative !important;
    z-index: 100000 !important;
    background: white !important;
}

.modal.show .modal-backdrop {
    z-index: 99999 !important;
}
</style>

<!-- Loading Screen -->
<div class="loading-screen" id="loadingScreen">
    <div class="loader-content">
        <div class="loader-logo">
            <img src="{{ asset('img/logo.png') }}" alt="Umalo" />
        </div>
        <div class="loader-spinner">
            <div class="spinner"></div>
        </div>
        <p class="loader-text">Loading Solutions...</p>
    </div>
</div>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-background">
        <div class="gradient-orb orb-1"></div>
        <div class="gradient-orb orb-2"></div>
        <div class="grid-overlay"></div>
    </div>

    <div class="container">
        <div class="hero-content">
            <div class="hero-tag" data-aos="fade-up">
                <span class="tag-pulse"></span>
                Umalo Solutions
            </div>

            <h1 class="hero-heading" data-aos="fade-up" data-aos-delay="100">
                Engineering Tomorrow's<br />
                <span class="text-gradient">Digital Infrastructure</span>
            </h1>

            <p class="hero-text" data-aos="fade-up" data-aos-delay="200">
                Cutting-edge technology solutions designed for enterprises that
                refuse to compromise on innovation, efficiency, and sustainability.
            </p>
        </div>
    </div>
</section>

<!-- Solutions Section -->
<section class="solutions" id="solutions">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <div class="section-tag">
                <i class="fas fa-layer-group"></i>
                Our Solutions
            </div>
            <h2 class="section-title">
                Transform Your Business with<br />
                <span class="text-gradient">Intelligent Systems</span>
            </h2>
            <p class="section-description">
                From paperless offices to renewable energy management, discover how
                our technology suite drives operational excellence and sustainable
                growth.
            </p>
        </div>

        <div class="solutions-list">
            @foreach($solutions as $index => $solution)
            <!-- Solution {{ $index + 1 }} -->
            <article class="solution {{ $index % 2 !== 0 ? 'solution-reverse' : '' }}" 
                     data-aos="fade-up" 
                     data-aos-delay="{{ ($index + 1) * 100 }}">
                <div class="solution-visual">
                    <div class="solution-number">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</div>
                    <div class="solution-image">
                        @if($solution->banner_image)
                        <img src="{{ asset($solution->banner_image) }}" alt="{{ $solution->title }}" />
                        @else
                        <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?w=1400&h=1050&fit=crop&q=90" 
                             alt="{{ $solution->title }}" />
                        @endif
                        <div class="image-gradient"></div>
                    </div>
                    <div class="solution-tag">
                        <i class="fas fa-{{ $solution->features->first()->feature_icon ?? 'cog' }}"></i>
                        {{ $solution->short_description }}
                    </div>
                </div>

                <div class="solution-info">
                    <h3 class="solution-name">{{ $solution->title }}</h3>
                    <p class="solution-description">
                        {{ $solution->overview_title }}
                    </p>

                    <div class="solution-features">
                        @foreach($solution->features->take(3) as $feature)
                        <div class="feature-tag">
                            <i class="fas fa-check"></i>
                            {{ $feature->feature_title }}
                        </div>
                        @endforeach
                    </div>

                    <div class="solution-stats">
                        <div class="stat">
                            <strong>95%</strong>
                            <span>Efficiency</span>
                        </div>
                        <div class="stat">
                            <strong>40%</strong>
                            <span>Time Saved</span>
                        </div>
                    </div>

                    <div class="solution-actions">
                        <button class="btn btn-primary" onclick="openModal('solution-{{ $solution->id }}')">
                            <span>Explore Solution</span>
                            <i class="fas fa-arrow-right"></i>
                        </button>
                        @if($solution->brochure_file)
                        <a href="{{ route('solutions.download', $solution->slug) }}" class="btn btn-ghost">
                            <i class="fas fa-download"></i>
                            <span>Download Brochure</span>
                        </a>
                        @else
                        <button class="btn btn-ghost">
                            <i class="fas fa-play-circle"></i>
                            <span>Watch Demo</span>
                        </button>
                        @endif
                    </div>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta" data-aos="fade-up">
    <div class="container">
        <div class="cta-content">
            <div class="cta-background">
                <div class="cta-orb"></div>
            </div>

            <div class="cta-text">
                <h2 class="cta-heading">
                    Ready to revolutionize<br />
                    your operations?
                </h2>
                <p class="cta-description">
                    Join 500+ forward-thinking companies already benefiting from our
                    solutions. Let's discuss how we can accelerate your digital
                    transformation.
                </p>
            </div>

            <div class="cta-actions">
                <a href="#contact" class="btn btn-white">
                    <span>Schedule Consultation</span>
                    <i class="fas fa-calendar-check"></i>
                </a>
                <a href="tel:+6281281653311" class="btn btn-outline-white">
                    <i class="fas fa-phone"></i>
                    <span>+62 812 8165 3311</span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Modal - Pastikan di luar semua section -->
<div class="modal" id="modal">
    <div class="modal-backdrop" onclick="closeModal()"></div>
    <div class="modal-container">
        <button class="modal-close" onclick="closeModal()">
            <i class="fas fa-times"></i>
        </button>

        <div class="modal-hero">
            <img id="modalImage" src="" alt="" />
            <div class="modal-hero-overlay">
                <h2 id="modalTitle"></h2>
                <p id="modalSubtitle"></p>
            </div>
        </div>

        <div class="modal-content">
            <div class="modal-section">
                <div class="section-icon">
                    <i class="fas fa-info-circle"></i>
                </div>
                <h3>Overview</h3>
                <p id="modalOverview"></p>
            </div>

            <div class="modal-section">
                <div class="section-icon">
                    <i class="fas fa-sparkles"></i>
                </div>
                <h3>Key Features</h3>
                <div class="modal-features" id="modalFeatures"></div>
            </div>

            <div class="modal-section">
                <div class="section-icon">
                    <i class="fas fa-trophy"></i>
                </div>
                <h3>Benefits & Impact</h3>
                <p id="modalBenefits"></p>
            </div>

            <div class="modal-actions">
                <button class="btn btn-primary btn-large" onclick="requestDemo()">
                    <i class="fas fa-calendar-check"></i>
                    <span>Request Demo</span>
                </button>
                <button class="btn btn-ghost btn-large" id="downloadBrochureBtn">
                    <i class="fas fa-download"></i>
                    <span>Download Brochure</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Back to Top -->
<button class="back-to-top" id="backToTop">
    <i class="fas fa-arrow-up"></i>
</button>

@endsection

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
// ===== SOLUTIONS DATA FROM DATABASE =====
const solutionsData = {
    @foreach($solutions as $solution)
    'solution-{{ $solution->id }}': {
        id: {{ $solution->id }},
        title: "{{ $solution->title }}",
        subtitle: "{{ $solution->short_description }}",
        image: "{{ $solution->banner_image ? asset($solution->banner_image) : 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=1400&h=1050&fit=crop&q=90' }}",
        overview: `{!! str_replace(["\r", "\n"], ' ', addslashes($solution->overview_description)) !!}`,
        features: [
            @foreach($solution->features as $feature)
            "{{ $feature->feature_title }}",
            @endforeach
        ],
        benefits: `{!! str_replace(["\r", "\n"], ' ', addslashes($solution->benefits)) !!}`,
        brochureUrl: "{{ $solution->brochure_file ? route('solutions.download', $solution->slug) : '' }}",
        contactLink: "{{ $solution->contact_link ?? '#' }}"
    },
    @endforeach
};

// ===== INITIALIZATION =====
document.addEventListener("DOMContentLoaded", function () {
    console.log("%c╔═══════════════════════════════════════════════════════╗", "color: #228B22; font-weight: bold; font-size: 14px");
    console.log("%c║   UMALO SOLUTIONS - LARAVEL VERSION                  ║", "color: #228B22; font-weight: bold; font-size: 16px");
    console.log("%c║   Updated: 2025-11-18 06:49:02 UTC                   ║", "color: #228B22; font-weight: bold; font-size: 14px");
    console.log("%c║   User: karinaamiriti                                ║", "color: #228B22; font-weight: bold; font-size: 14px");
    console.log("%c╚═══════════════════════════════════════════════════════╝", "color: #228B22; font-weight: bold; font-size: 14px");

    // Initialize all features
    initializeAOS();
    initializeLoading();
    initializeScrollEffects();
    initializeModal();
});

// ===== AOS ANIMATION =====
function initializeAOS() {
    if (typeof AOS !== "undefined") {
        AOS.init({
            duration: 1200,
            easing: "ease-out-cubic",
            once: true,
            offset: 80,
            delay: 50,
            disable: "mobile",
        });
        console.log("✅ AOS Animation Library Initialized");
    }
}

// ===== LOADING SCREEN =====
function initializeLoading() {
    const loadingScreen = document.getElementById("loadingScreen");
    if (loadingScreen) {
        setTimeout(() => {
            loadingScreen.classList.add("fade-out");
            setTimeout(() => {
                loadingScreen.style.display = "none";
                document.body.style.overflow = "";
            }, 500);
        }, 1200);
        console.log("✅ Loading Screen Initialized");
    }
}

// ===== SCROLL EFFECTS =====
function initializeScrollEffects() {
    const backToTop = document.getElementById("backToTop");
    
    if (backToTop) {
        window.addEventListener("scroll", () => {
            if (window.pageYOffset > 600) {
                backToTop.classList.add("visible");
            } else {
                backToTop.classList.remove("visible");
            }
        });

        backToTop.addEventListener("click", () => {
            window.scrollTo({ top: 0, behavior: "smooth" });
        });
    }

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener("click", function (e) {
            const href = this.getAttribute("href");
            if (href !== "#" && href.length > 1) {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    const offsetTop = target.offsetTop - 90;
                    window.scrollTo({ top: offsetTop, behavior: "smooth" });
                }
            }
        });
    });

    console.log("✅ Scroll Effects Initialized");
}

// ===== MODAL FUNCTIONS =====
function initializeModal() {
    const modal = document.getElementById("modal");
    
    if (!modal) {
        console.error("❌ Modal element not found!");
        return;
    }

    const modalBackdrop = modal.querySelector(".modal-backdrop");

    if (modalBackdrop) {
        modalBackdrop.addEventListener("click", closeModal);
    }

    // Close modal with ESC key
    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape" && modal.classList.contains("show")) {
            closeModal();
        }
    });

    console.log("✅ Modal System Initialized");
    console.log("📊 Solutions Loaded:", Object.keys(solutionsData).length);
}

function openModal(solutionId) {
    console.log("🔓 Opening modal for:", solutionId);

    const data = solutionsData[solutionId];

    if (!data) {
        console.error("❌ Solution data not found:", solutionId);
        alert("Error: Solution data not found!");
        return;
    }

    const modal = document.getElementById("modal");
    
    if (!modal) {
        console.error("❌ Modal element not found in DOM!");
        return;
    }

    // Populate modal content dengan null checking
    const modalImage = document.getElementById("modalImage");
    const modalTitle = document.getElementById("modalTitle");
    const modalSubtitle = document.getElementById("modalSubtitle");
    const modalOverview = document.getElementById("modalOverview");
    const modalBenefits = document.getElementById("modalBenefits");
    
    if (modalImage) {
        modalImage.src = data.image;
        modalImage.alt = data.title;
    }
    if (modalTitle) modalTitle.textContent = data.title;
    if (modalSubtitle) modalSubtitle.textContent = data.subtitle;
    if (modalOverview) modalOverview.textContent = data.overview;
    if (modalBenefits) modalBenefits.textContent = data.benefits;

    // Populate features
    const featuresContainer = document.getElementById("modalFeatures");
    if (featuresContainer) {
        featuresContainer.innerHTML = "";

        data.features.forEach((feature, index) => {
            const featureDiv = document.createElement("div");
            featureDiv.className = "modal-feature";
            featureDiv.style.animationDelay = `${index * 0.05}s`;
            featureDiv.innerHTML = `
                <div class="modal-feature-icon">✓</div>
                <div class="modal-feature-text">${feature}</div>
            `;
            featuresContainer.appendChild(featureDiv);
        });
    }

    // Setup download brochure button
    const downloadBtn = document.getElementById("downloadBrochureBtn");
    if (downloadBtn) {
        if (data.brochureUrl) {
            downloadBtn.onclick = () => window.location.href = data.brochureUrl;
        } else {
            downloadBtn.onclick = () => alert("Brochure not available");
        }
    }

    // Show modal dengan delay untuk animasi
    requestAnimationFrame(() => {
        modal.classList.add("show");
        document.body.style.overflow = "hidden";
        console.log("✅ Modal opened successfully!");
        console.log("Modal classes:", modal.className);
        console.log("Modal display:", window.getComputedStyle(modal).display);
        console.log("Modal z-index:", window.getComputedStyle(modal).zIndex);
    });
}

function closeModal() {
    console.log("🔒 Closing modal");
    const modal = document.getElementById("modal");
    if (modal) {
        modal.classList.remove("show");
        document.body.style.overflow = "";
    }
}

function requestDemo() {
    console.log("📅 Demo request initiated");
    
    const message = `
╔════════════════════════════════════════════════╗
║         DEMO REQUEST SUBMITTED                 ║
╚════════════════════════════════════════════════╝

✅ Thank you for your interest in Umalo Solutions!

Our enterprise solutions team will contact you within 
24 business hours to schedule a personalized demo.

📞 CONTACT INFORMATION:
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
• Phone:     +62 812 8165 3311
• Email:     solutions@umalo.com
• WhatsApp:  Available 24/7
• Website:   www.umalo.com

🕐 BUSINESS HOURS:
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
• Mon-Fri:   09:00 - 18:00 WIB
• Saturday:  09:00 - 14:00 WIB
• Sunday:    Closed

We look forward to transforming your business!
    `;

    alert(message);
    closeModal();
}

console.log("\n%c✅ INITIALIZATION COMPLETE", "color: #228B22; font-weight: bold; font-size: 16px; background: #e6ffe6; padding: 12px; border-radius: 6px");
console.log("%c🚀 Laravel Integration: Active", "color: #207178; font-size: 12px; font-weight: bold");
console.log("%c📊 Solutions Loaded: {{ $solutions->count() }}", "color: #207178; font-size: 12px; font-weight: bold");
console.log("%c👤 User: karinaamiriti", "color: #207178; font-size: 12px; font-weight: bold");
console.log("%c🕐 Time: 2025-11-18 06:49:02 UTC", "color: #207178; font-size: 12px; font-weight: bold");
</script>
@endpush