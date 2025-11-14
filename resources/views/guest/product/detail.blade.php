@extends('layouts.guest.master3')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
<style>
/* ==========================================
   PRODUCT DETAIL PAGE - PREMIUM DESIGN
   ========================================== */

:root {
  --primary: #107c10;
  --primary-dark: #0a5c0a;
  --primary-light: #e8f5e9;
  --dark: #1f2937;
  --gray: #6b7280;
  --light-gray: #f5f5f5;
  --lighter-gray: #fafafa;
  --border: #e5e7eb;
  --border-light: #f0f0f0;
  --white: #ffffff;
  --orange: #ff9900;
  --red: #dc2626;
  --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
  --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
  --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
}

/* ==========================================
   BREADCRUMB - IMPROVED SPACING & DESIGN
   ========================================== */
.breadcrumb-section {
  background: linear-gradient(135deg, #f9fafb 0%, #ffffff 100%);
  border-bottom: 2px solid var(--border-light);
  padding: 24px 0;
  margin-top: 90px;
}

.breadcrumb {
  display: flex;
  align-items: center;
  gap: 12px;
  font-size: 14px;
  max-width: 1400px;
  margin: 0 auto;
  padding: 0 20px;
  flex-wrap: wrap;
}

.breadcrumb a {
  color: var(--primary);
  text-decoration: none;
  display: flex;
  align-items: center;
  gap: 8px;
  transition: all 0.3s ease;
  font-weight: 600;
  padding: 6px 12px;
  border-radius: 6px;
}

.breadcrumb a:hover {
  background: var(--primary-light);
  color: var(--primary-dark);
}

.breadcrumb i.fa-home {
  font-size: 14px;
}

.breadcrumb i.fa-chevron-right {
  color: var(--gray);
  font-size: 11px;
  opacity: 0.6;
}

.breadcrumb span {
  color: var(--gray);
  font-weight: 500;
  max-width: 400px;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

/* ==========================================
   DETAIL CONTAINER
   ========================================== */
.detail-container {
  background: var(--white);
  padding: 50px 0;
}

.container-wide {
  max-width: 1400px;
  margin: 0 auto;
  padding: 0 20px;
}

.product-detail-wrapper {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 60px;
}

/* ==========================================
   PRODUCT IMAGES SECTION - IMPROVED
   ========================================== */
.product-images-section {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.main-image-wrapper {
  position: relative;
  width: 100%;
  border: 1px solid var(--border-light);
  border-radius: 16px;
  overflow: hidden;
  background: linear-gradient(135deg, #f9fafb 0%, #ffffff 100%);
  aspect-ratio: 1;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.main-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.5s ease;
  cursor: zoom-in;
}

.main-image-wrapper:hover .main-image {
  transform: scale(1.03);
}

/* Watermark Logo - Smaller & More Subtle */
.watermark-logo {
  position: absolute;
  bottom: 20px;
  right: 20px;
  width: 120px;
  height: auto;
  opacity: 0.15;
  pointer-events: none;
  z-index: 1;
}

.image-actions {
  position: absolute;
  top: 20px;
  right: 20px;
  display: flex;
  gap: 12px;
  z-index: 2;
}

.action-btn {
  width: 44px;
  height: 44px;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(10px);
  border: 1px solid var(--border);
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--gray);
  transition: all 0.3s ease;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.action-btn:hover {
  background: var(--primary);
  color: white;
  border-color: var(--primary);
  transform: scale(1.1) translateY(-2px);
  box-shadow: 0 6px 20px rgba(16, 124, 16, 0.3);
}

/* Thumbnail Container */
.thumbnail-container {
  width: 100%;
  overflow: hidden;
}

.thumbnail-scroll {
  display: flex;
  gap: 14px;
  overflow-x: auto;
  padding-bottom: 10px;
}

.thumbnail-scroll::-webkit-scrollbar {
  height: 8px;
}

.thumbnail-scroll::-webkit-scrollbar-track {
  background: var(--border-light);
  border-radius: 4px;
}

.thumbnail-scroll::-webkit-scrollbar-thumb {
  background: var(--primary);
  border-radius: 4px;
}

.thumbnail {
  width: 90px;
  height: 90px;
  min-width: 90px;
  border-radius: 10px;
  border: 2px solid var(--border-light);
  cursor: pointer;
  object-fit: cover;
  transition: all 0.3s ease;
  box-shadow: var(--shadow-sm);
}

.thumbnail:hover {
  border-color: var(--primary);
  transform: translateY(-3px);
  box-shadow: var(--shadow-md);
}

.thumbnail.active {
  border-color: var(--primary);
  border-width: 3px;
  box-shadow: 0 0 12px rgba(16, 124, 16, 0.4);
}

/* ==========================================
   PRODUCT INFO SECTION - IMPROVED
   ========================================== */
.product-info-section {
  display: flex;
  flex-direction: column;
  gap: 32px;
}

.product-header {
  margin-bottom: 0;
}

.product-name {
  font-size: 36px;
  font-weight: 800;
  color: var(--dark);
  line-height: 1.2;
  letter-spacing: -0.8px;
  margin-bottom: 0;
}

/* Product Meta Cards - IMPROVED */
.product-meta-cards {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 18px;
}

.meta-card {
  background: linear-gradient(135deg, var(--lighter-gray) 0%, var(--white) 100%);
  border: 2px solid var(--border-light);
  border-radius: 14px;
  padding: 20px;
  display: flex;
  align-items: center;
  gap: 16px;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  position: relative;
  overflow: hidden;
}

.meta-card::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 5px;
  height: 100%;
  background: linear-gradient(180deg, var(--primary) 0%, var(--primary-dark) 100%);
  transform: scaleY(0);
  transition: transform 0.3s ease;
}

.meta-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 8px 24px rgba(16, 124, 16, 0.15);
  border-color: var(--primary);
  background: white;
}

.meta-card:hover::before {
  transform: scaleY(1);
}

.meta-icon {
  width: 54px;
  height: 54px;
  background: linear-gradient(135deg, var(--primary-light) 0%, var(--white) 100%);
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 22px;
  color: var(--primary);
  flex-shrink: 0;
  box-shadow: 0 4px 12px rgba(16, 124, 16, 0.1);
  transition: all 0.3s ease;
}

.meta-card:hover .meta-icon {
  background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
  color: white;
  transform: scale(1.1);
}

.meta-content {
  display: flex;
  flex-direction: column;
  gap: 5px;
  flex: 1;
}

.meta-label {
  font-size: 11px;
  font-weight: 800;
  color: var(--gray);
  text-transform: uppercase;
  letter-spacing: 1px;
}

.meta-value {
  font-size: 16px;
  font-weight: 700;
  color: var(--dark);
  letter-spacing: -0.3px;
  line-height: 1.3;
}

.meta-value a {
  color: var(--primary);
  text-decoration: none;
  transition: color 0.3s ease;
}

.meta-value a:hover {
  color: var(--primary-dark);
  text-decoration: underline;
}

/* Action Buttons Wrapper - IMPROVED */
.action-buttons-wrapper {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 16px;
  margin-top: 10px;
}

.btn-contact-primary,
.btn-catalog-secondary {
  padding: 18px 28px;
  border: none;
  border-radius: 12px;
  font-weight: 700;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 12px;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  font-size: 15px;
  position: relative;
  overflow: hidden;
  text-decoration: none;
  box-shadow: var(--shadow-md);
}

.btn-contact-primary {
  background: linear-gradient(135deg, #25d366 0%, #1da851 100%);
  color: white;
  box-shadow: 0 6px 20px rgba(37, 211, 102, 0.35);
}

.btn-contact-primary::before {
  content: "";
  position: absolute;
  top: 50%;
  left: 50%;
  width: 0;
  height: 0;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.3);
  transform: translate(-50%, -50%);
  transition: width 0.6s, height 0.6s;
}

.btn-contact-primary:hover::before {
  width: 350px;
  height: 350px;
}

.btn-contact-primary:hover {
  transform: translateY(-3px);
  box-shadow: 0 10px 30px rgba(37, 211, 102, 0.5);
}

.btn-contact-primary i,
.btn-contact-primary span {
  position: relative;
  z-index: 1;
}

.btn-catalog-secondary {
  background: var(--white);
  color: var(--primary);
  border: 2px solid var(--primary);
  box-shadow: 0 4px 12px rgba(16, 124, 16, 0.1);
}

.btn-catalog-secondary:hover {
  background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
  color: white;
  transform: translateY(-3px);
  box-shadow: 0 10px 30px rgba(16, 124, 16, 0.4);
}

/* Additional Info - IMPROVED */
.additional-info {
  background: linear-gradient(135deg, var(--primary-light) 0%, rgba(16, 124, 16, 0.05) 100%);
  border-radius: 14px;
  padding: 24px;
  display: flex;
  flex-direction: column;
  gap: 16px;
  border: 2px solid rgba(16, 124, 16, 0.1);
}

.info-item {
  display: flex;
  align-items: center;
  gap: 14px;
  font-size: 14px;
  color: var(--dark);
  font-weight: 600;
}

.info-item i {
  width: 40px;
  height: 40px;
  background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-size: 18px;
  flex-shrink: 0;
  box-shadow: 0 4px 12px rgba(16, 124, 16, 0.3);
}

/* ==========================================
   DESCRIPTION SECTION
   ========================================== */
.description-section {
  background: var(--lighter-gray);
  padding: 70px 0;
  border-top: 2px solid var(--border-light);
}

.tabs-container {
  width: 100%;
}

.tabs-header {
  display: flex;
  gap: 0;
  border-bottom: 3px solid var(--border-light);
  margin-bottom: 40px;
  background: white;
  border-radius: 12px 12px 0 0;
  padding: 0 20px;
}

.tab-btn {
  padding: 18px 28px;
  background: none;
  border: none;
  cursor: pointer;
  font-size: 15px;
  font-weight: 700;
  color: var(--gray);
  border-bottom: 4px solid transparent;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  gap: 10px;
  position: relative;
  margin-bottom: -3px;
}

.tab-btn:hover {
  color: var(--primary);
  background: var(--primary-light);
}

.tab-btn.active {
  color: var(--primary);
  border-bottom-color: var(--primary);
  background: var(--primary-light);
}

.tab-content {
  display: none;
  animation: fadeIn 0.4s ease;
  background: white;
  padding: 40px;
  border-radius: 0 0 12px 12px;
}

.tab-content.active {
  display: block;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}

.description-content h3 {
  font-size: 20px;
  font-weight: 700;
  margin-bottom: 16px;
  color: var(--dark);
}

.description-content h4 {
  font-size: 16px;
  font-weight: 600;
  margin: 28px 0 14px;
  color: var(--dark);
}

.description-content p {
  font-size: 15px;
  line-height: 1.8;
  color: var(--gray);
  margin-bottom: 18px;
}

/* ==========================================
   RELATED PRODUCTS SECTION
   ========================================== */
.related-products-section {
  background: var(--white);
  padding: 70px 0;
}

.section-title {
  font-size: 28px;
  font-weight: 800;
  color: var(--dark);
  margin-bottom: 40px;
  letter-spacing: -0.5px;
}

.related-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 20px;
}

.product-card {
  background: var(--white);
  border: 1px solid var(--border-light);
  border-radius: 12px;
  overflow: hidden;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  cursor: pointer;
  display: flex;
  flex-direction: column;
  position: relative;
  height: 100%;
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

.product-card-link {
  text-decoration: none;
  color: inherit;
  display: block;
  height: 100%;
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
  z-index: 2;
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
  z-index: 2;
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

/* ==========================================
   RESPONSIVE
   ========================================== */

@media (max-width: 1200px) {
  .related-grid {
    grid-template-columns: repeat(3, 1fr);
  }
  
  .product-name {
    font-size: 30px;
  }
}

@media (max-width: 1024px) {
  .product-detail-wrapper {
    grid-template-columns: 1fr;
    gap: 40px;
  }

  .breadcrumb-section {
    margin-top: 75px;
    padding: 20px 0;
  }
}

@media (max-width: 768px) {
  .product-name {
    font-size: 24px;
  }

  .product-meta-cards {
    grid-template-columns: 1fr;
    gap: 14px;
  }

  .action-buttons-wrapper {
    grid-template-columns: 1fr;
    gap: 14px;
  }

  .related-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
  }

  .tabs-header {
    overflow-x: auto;
    padding: 0 10px;
  }

  .tab-btn {
    padding: 14px 20px;
    font-size: 14px;
  }

  .breadcrumb-section {
    margin-top: 65px;
    padding: 18px 0;
  }
  
  .breadcrumb {
    font-size: 13px;
  }
}

@media (max-width: 480px) {
  .product-name {
    font-size: 20px;
  }

  .related-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 12px;
  }

  .main-image-wrapper {
    aspect-ratio: auto;
    height: 320px;
  }

  .logo-badge {
    width: 44px;
    height: 44px;
  }

  .logo-badge img {
    width: 30px;
    height: 30px;
  }

  .product-info {
    padding: 12px;
  }
  
  .watermark-logo {
    width: 80px;
    bottom: 15px;
    right: 15px;
  }
}
</style>
@endpush

@section('content')
<!-- Breadcrumb - Improved -->
<div class="breadcrumb-section">
    <nav class="breadcrumb">
        <a href="{{ route('home') }}">
            <i class="fas fa-home"></i>
            <span>{{ __('messages.home') }}</span>
        </a>
        <i class="fas fa-chevron-right"></i>
        <a href="{{ route('product.index') }}">{{ __('messages.products') }}</a>
        <i class="fas fa-chevron-right"></i>
        <span title="{{ $product->name }}">{{ $product->name }}</span>
    </nav>
</div>

<!-- Main Content -->
<div class="detail-container">
    <div class="container-wide">
        <!-- Product Detail Section -->
        <div class="product-detail-wrapper">
            <!-- Left Section - Images -->
            <div class="product-images-section" data-aos="fade-right">
                <div class="main-image-wrapper">
                    @if($product->images->isNotEmpty())
                        <img src="{{ asset($product->images->first()->images) }}" 
                             alt="{{ $product->name }}" 
                             class="main-image" 
                             id="mainImage">
                    @else
                        <img src="https://via.placeholder.com/500x500/f3f4f6/107c10?text=Product" 
                             alt="{{ $product->name }}" 
                             class="main-image" 
                             id="mainImage">
                    @endif
                    
                    <!-- Watermark Logo - Smaller -->
                    <img src="{{ asset($company->logo ?? 'assets/img/logo.png') }}" alt="Umalo" class="watermark-logo">
                    
                    <div class="image-actions">
                        <button class="action-btn share-btn" title="Share">
                            <i class="fas fa-share-alt"></i>
                        </button>
                        <button class="action-btn favorite-btn" title="Add to Wishlist">
                            <i class="far fa-heart"></i>
                        </button>
                    </div>
                </div>

                @if($product->images->count() > 1)
                <div class="thumbnail-container">
                    <div class="thumbnail-scroll">
                        @foreach($product->images as $key => $image)
                            <img src="{{ asset($image->images) }}" 
                                 alt="Thumbnail {{ $key + 1 }}" 
                                 class="thumbnail {{ $key == 0 ? 'active' : '' }}" 
                                 onclick="changeImage('{{ asset($image->images) }}', this)">
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Right Section - Product Info -->
            <div class="product-info-section" data-aos="fade-left">
                <!-- Product Header -->
                <div class="product-header">
                    <h1 class="product-name">{{ $product->name }}</h1>
                </div>

                <!-- Product Meta Cards -->
                <div class="product-meta-cards">
                    <div class="meta-card">
                        <div class="meta-icon">
                            <i class="fas fa-tag"></i>
                        </div>
                        <div class="meta-content">
                            <span class="meta-label">{{ __('messages.brand') }}</span>
                            <span class="meta-value">{{ $product->brand ?? 'Umalo' }}</span>
                        </div>
                    </div>

                    <div class="meta-card">
                        <div class="meta-icon">
                            <i class="fas fa-layer-group"></i>
                        </div>
                        <div class="meta-content">
                            <span class="meta-label">{{ __('messages.category') }}</span>
                            <span class="meta-value">{{ $product->category->name }}</span>
                        </div>
                    </div>

                    <div class="meta-card">
                        <div class="meta-icon">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <div class="meta-content">
                            <span class="meta-label">{{ __('messages.usage') }}</span>
                            <span class="meta-value">{{ Str::limit($product->usage, 30) }}</span>
                        </div>
                    </div>

                    @if($product->ekatalog)
                    <div class="meta-card">
                        <div class="meta-icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div class="meta-content">
                            <span class="meta-label">E-Katalog</span>
                            <span class="meta-value">
                                <a href="{{ (strpos($product->ekatalog, 'http://') === 0 || strpos($product->ekatalog, 'https://') === 0) ? $product->ekatalog : 'http://' . $product->ekatalog }}" 
                                   target="_blank">
                                    Lihat Katalog
                                </a>
                            </span>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons-wrapper">
                    <a href="https://wa.me/6285282651911?text={{ urlencode('Halo, saya ingin menanyakan produk ' . $product->name) }}" 
                       class="btn-contact-primary" 
                       target="_blank">
                        <i class="fab fa-whatsapp"></i>
                        <span>{{ __('messages.contact_admin') }}</span>
                    </a>

                    @if($product->brosur->isNotEmpty())
                        @php
                            $brosur = $product->brosur->first();
                        @endphp
                        <a href="{{ asset($brosur->file) }}" 
                           class="btn-catalog-secondary" 
                           target="_blank">
                            <i class="fas fa-file-pdf"></i>
                            <span>{{ __('messages.view_brochure') }}</span>
                        </a>
                    @else
                        <button class="btn-catalog-secondary" disabled style="opacity: 0.5; cursor: not-allowed;">
                            <i class="fas fa-file-pdf"></i>
                            <span>No Brochure</span>
                        </button>
                    @endif
                </div>

                <!-- Additional Info -->
                <div class="additional-info">
                    <div class="info-item">
                        <i class="fas fa-shield-alt"></i>
                        <span>Garansi Resmi 1 Tahun</span>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-truck"></i>
                        <span>Pengiriman ke Seluruh Indonesia</span>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-headset"></i>
                        <span>Support 24/7</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Description Section -->
<section class="description-section">
    <div class="container-wide">
        <div class="tabs-container">
            <div class="tabs-header">
                <button class="tab-btn active" onclick="openTab(event, 'deskripsi')">
                    <i class="fas fa-info-circle"></i> {{ __('messages.description') }}
                </button>
                <button class="tab-btn" onclick="openTab(event, 'spesifikasi')">
                    <i class="fas fa-list"></i> {{ __('messages.specifications') }}
                </button>
            </div>

            <!-- Deskripsi Tab -->
            <div id="deskripsi" class="tab-content active">
                <div class="description-content">
                    <h3>{{ __('messages.about_product') }}</h3>
                    <p>{{ $product->usage }}</p>

                    @if($product->description)
                        <h4>{{ __('messages.details') }}</h4>
                        <p>{!! nl2br(e($product->description)) !!}</p>
                    @endif
                </div>
            </div>

            <!-- Spesifikasi Tab -->
            <div id="spesifikasi" class="tab-content">
                <div class="specifications-content">
                    <table class="table" style="width: 100%;">
                        <tbody>
                            <tr style="border-bottom: 1px solid var(--border-light);">
                                <th style="width: 30%; padding: 16px 0; font-weight: 600; color: var(--dark);">
                                    {{ __('messages.brand') }}
                                </th>
                                <td style="padding: 16px 0 16px 24px; color: var(--gray);">
                                    {{ $product->brand ?? 'Umalo' }}
                                </td>
                            </tr>
                            <tr style="border-bottom: 1px solid var(--border-light);">
                                <th style="width: 30%; padding: 16px 0; font-weight: 600; color: var(--dark);">
                                    {{ __('messages.category') }}
                                </th>
                                <td style="padding: 16px 0 16px 24px; color: var(--gray);">
                                    {{ $product->category->name }}
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 30%; padding: 16px 0; font-weight: 600; color: var(--dark);">
                                    {{ __('messages.usage') }}
                                </th>
                                <td style="padding: 16px 0 16px 24px; color: var(--gray);">
                                    {{ $product->usage }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Products Section -->
<section class="related-products-section">
    <div class="container-wide">
        <h2 class="section-title">{{ __('messages.other_products') }}</h2>

        <div class="related-grid">
            @foreach($productLainnya as $relatedProduct)
                <a href="{{ route('product.show', $relatedProduct->slug) }}" class="product-card-link">
                    <div class="product-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="product-image-wrapper">
                            <img src="{{ asset($relatedProduct->images->first()->images ?? 'https://via.placeholder.com/500x500/f3f4f6/107c10?text=Product') }}" 
                                 alt="{{ $relatedProduct->name }}" 
                                 class="product-image"
                                 onerror="this.onerror=null; this.src='https://via.placeholder.com/500x500/f3f4f6/107c10?text=Product'">
                            
                            <div class="badge-container">
                                @if($relatedProduct->discount ?? false)
                                    <span class="discount-badge">-{{ $relatedProduct->discount }}%</span>
                                @endif
                                @if($relatedProduct->is_featured ?? false)
                                    <span class="featured-badge">Unggulan</span>
                                @endif
                            </div>
                            
                            <div class="logo-badge">
                                <img src="{{ asset($company->logo ?? 'assets/img/logo.png') }}" alt="Umalo">
                            </div>
                        </div>
                        
                        <div class="product-info">
                            <h3 class="product-title">{{ $relatedProduct->name }}</h3>
                            <div class="product-divider"></div>
                            <p class="product-seller">
                                <i class="fas fa-store"></i>
                                Umalo Official Store
                            </p>
                            <div class="product-meta">
                                <span class="badge-official">
                                    <i class="fas fa-check-circle"></i> Official
                                </span>
                                @if($relatedProduct->stock ?? false)
                                    <span class="stock-info">Stok: {{ $relatedProduct->stock }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
AOS.init({
    duration: 600,
    easing: "ease-in-out",
    once: true,
});

function changeImage(src, element) {
    const mainImage = document.getElementById('mainImage');
    mainImage.src = src;

    document.querySelectorAll('.thumbnail').forEach(thumb => {
        thumb.classList.remove('active');
    });
    element.classList.add('active');
}

function openTab(evt, tabName) {
    const contents = document.querySelectorAll('.tab-content');
    const btns = document.querySelectorAll('.tab-btn');

    contents.forEach(content => {
        content.classList.remove('active');
    });

    btns.forEach(btn => {
        btn.classList.remove('active');
    });

    document.getElementById(tabName).classList.add('active');
    evt.currentTarget.classList.add('active');
}

document.querySelector('.favorite-btn')?.addEventListener('click', function() {
    this.classList.toggle('active');
    const icon = this.querySelector('i');

    if (this.classList.contains('active')) {
        icon.classList.remove('far');
        icon.classList.add('fas');
        this.style.color = '#dc2626';
    } else {
        icon.classList.remove('fas');
        icon.classList.add('far');
        this.style.color = '';
    }
});

document.querySelector('.share-btn')?.addEventListener('click', function() {
    if (navigator.share) {
        navigator.share({
            title: '{{ $product->name }}',
            text: 'Lihat produk menarik ini dari Umalo',
            url: window.location.href
        });
    } else {
        navigator.clipboard.writeText(window.location.href);
        alert('Link copied to clipboard!');
    }
});
</script>
@endpush