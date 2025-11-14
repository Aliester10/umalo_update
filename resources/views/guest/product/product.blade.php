@extends('layouts.guest.master')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
<style>
/* ==========================================
   UMALO PRODUCTS - INTERNATIONAL CORPORATE STYLE
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
  --transition-fast: 150ms cubic-bezier(0.4, 0, 0.2, 1);
  --transition-base: 300ms cubic-bezier(0.4, 0, 0.2, 1);
}

/* ==========================================
   HERO SECTION - INTERNATIONAL STYLE
   ========================================== */
.hero-international {
  position: relative;
  padding: 120px 0 80px;
  background: linear-gradient(135deg, #0f1419 0%, #1a2332 50%, #0f1419 100%);
  overflow: hidden;
}

.hero-gradient-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: radial-gradient(
      circle at 20% 30%,
      rgba(16, 124, 16, 0.15) 0%,
      transparent 50%
    ),
    radial-gradient(
      circle at 80% 70%,
      rgba(59, 130, 246, 0.1) 0%,
      transparent 50%
    );
  pointer-events: none;
}

.hero-pattern {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-image: linear-gradient(
      rgba(255, 255, 255, 0.02) 1px,
      transparent 1px
    ),
    linear-gradient(90deg, rgba(255, 255, 255, 0.02) 1px, transparent 1px);
  background-size: 50px 50px;
  pointer-events: none;
}

.hero-content-international {
  position: relative;
  z-index: 10;
  max-width: 900px;
  margin: 0 auto;
  text-align: center;
}

.breadcrumb-international {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 8px 24px;
  background: rgba(255, 255, 255, 0.08);
  backdrop-filter: blur(10px);
  border-radius: 50px;
  border: 1px solid rgba(255, 255, 255, 0.1);
  font-size: 13px;
  font-weight: 600;
  color: rgba(255, 255, 255, 0.7);
  margin-bottom: 40px;
}

.breadcrumb-international a {
  color: rgba(255, 255, 255, 0.7);
  text-decoration: none;
  transition: color var(--transition-fast);
  display: inline-flex;
  align-items: center;
  gap: 6px;
}

.breadcrumb-international a:hover {
  color: var(--white);
}

.breadcrumb-international .active {
  color: var(--white);
}

.breadcrumb-international i.fa-chevron-right {
  font-size: 10px;
  opacity: 0.5;
}

.hero-title-international {
  font-size: 64px;
  font-weight: 800;
  color: var(--white);
  line-height: 1.1;
  margin-bottom: 24px;
  letter-spacing: -2px;
}

.highlight-text {
  background: linear-gradient(135deg, #107c10 0%, #14b8a6 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.hero-description-international {
  font-size: 18px;
  color: rgba(255, 255, 255, 0.85);
  line-height: 1.8;
  max-width: 750px;
  margin: 0 auto;
}

/* ==========================================
   MAIN CONTAINER
   ========================================== */
.main-container {
  background: var(--lighter-gray);
  padding: 32px 0;
  min-height: calc(100vh - 200px);
  position: relative;
}

.container-wide {
  max-width: 1400px;
  margin: 0 auto;
  padding: 0 20px;
}

.products-wrapper {
  display: grid;
  grid-template-columns: 280px 1fr;
  gap: 24px;
  align-items: start;
}

/* ==========================================
   SIDEBAR - CLEAN MINIMAL (NON-STICKY)
   ========================================== */
.filter-sidebar {
  background: white;
  border-radius: 12px;
  border: 1px solid var(--border);
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
  overflow: hidden;
  height: fit-content;
}

.filter-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 20px;
  border-bottom: 1px solid var(--border);
  margin: 0;
}

.filter-header h3 {
  font-size: 18px;
  font-weight: 700;
  color: var(--dark);
  margin: 0;
  letter-spacing: -0.3px;
}

.close-filter {
  display: none;
  background: none;
  border: none;
  cursor: pointer;
  color: var(--gray);
  transition: all 0.2s ease;
  width: 28px;
  height: 28px;
  border-radius: 6px;
  align-items: center;
  justify-content: center;
  font-size: 18px;
}

.close-filter:hover {
  background: var(--light-gray);
  color: var(--dark);
}

.filter-content {
  padding: 20px;
}

.filter-group {
  margin-bottom: 28px;
}

.filter-group:last-child {
  margin-bottom: 0;
}

.filter-group h4 {
  font-size: 12px;
  font-weight: 800;
  margin-bottom: 16px;
  color: var(--dark);
  text-transform: uppercase;
  letter-spacing: 1px;
}

.filter-options {
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.filter-checkbox {
  display: flex;
  align-items: center;
  gap: 12px;
  cursor: pointer;
  font-size: 14px;
  color: var(--dark);
  user-select: none;
  transition: all 0.2s ease;
  padding: 0;
  text-decoration: none;
  font-weight: 500;
}

.filter-checkbox:hover {
  color: var(--primary);
}

.filter-checkbox input[type="checkbox"] {
  width: 20px;
  height: 20px;
  min-width: 20px;
  border: 2px solid var(--border);
  border-radius: 4px;
  cursor: pointer;
  transition: all 0.2s ease;
  appearance: none;
  -webkit-appearance: none;
  background: white;
  position: relative;
  margin: 0;
}

.filter-checkbox input[type="checkbox"]:checked {
  background: var(--primary);
  border-color: var(--primary);
}

.filter-checkbox input[type="checkbox"]:checked::after {
  content: '✓';
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: white;
  font-size: 14px;
  font-weight: bold;
}

.filter-checkbox input[type="checkbox"]:hover {
  border-color: var(--primary);
}

/* ==========================================
   PRODUCTS MAIN
   ========================================== */
.products-main {
  background: white;
  border-radius: 12px;
  padding: 24px;
  border: 1px solid var(--border);
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.products-controls {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 24px;
  padding-bottom: 20px;
  border-bottom: 1px solid var(--border);
  flex-wrap: wrap;
  gap: 16px;
}

.filter-btn-mobile {
  display: none;
  padding: 10px 18px;
  background: white;
  border: 2px solid var(--primary);
  border-radius: 8px;
  cursor: pointer;
  font-size: 14px;
  font-weight: 700;
  color: var(--primary);
  gap: 8px;
  transition: all 0.3s ease;
  align-items: center;
}

.filter-btn-mobile:hover {
  background: var(--primary);
  color: white;
}

.sort-section {
  display: flex;
  align-items: center;
  gap: 20px;
  flex-wrap: wrap;
}

.product-count {
  font-size: 14px;
  color: var(--gray);
  font-weight: 600;
}

.product-count strong {
  color: var(--primary);
  font-weight: 800;
}

.sort-select {
  padding: 10px 14px;
  border: 1px solid var(--border);
  border-radius: 8px;
  background: white;
  font-size: 14px;
  color: var(--dark);
  cursor: pointer;
  transition: all 0.3s ease;
  font-weight: 600;
  min-width: 160px;
}

.sort-select:hover {
  border-color: var(--primary);
}

.sort-select:focus {
  outline: none;
  border-color: var(--primary);
  box-shadow: 0 0 0 3px rgba(16, 124, 16, 0.1);
}

/* Products Grid */
.products-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 20px;
}

/* Product Card */
.product-card {
  background: white;
  border: 1px solid var(--border);
  border-radius: 12px;
  overflow: hidden;
  transition: all 0.3s ease;
  cursor: pointer;
  display: flex;
  flex-direction: column;
  position: relative;
  height: 100%;
}

.product-card:hover {
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
  transform: translateY(-4px);
  border-color: var(--primary);
}

.product-image-wrapper {
  position: relative;
  width: 100%;
  padding-bottom: 100%;
  overflow: hidden;
  background: var(--lighter-gray);
}

.product-image {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.4s ease;
}

.product-card:hover .product-image {
  transform: scale(1.05);
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
  flex-direction: column;
  gap: 6px;
  z-index: 2;
}

.discount-badge {
  background: var(--red);
  color: white;
  padding: 6px 10px;
  border-radius: 6px;
  font-size: 11px;
  font-weight: 800;
  text-transform: uppercase;
}

.featured-badge {
  background: var(--orange);
  color: white;
  padding: 6px 10px;
  border-radius: 6px;
  font-size: 11px;
  font-weight: 700;
  text-transform: uppercase;
}

.logo-badge {
  position: absolute;
  bottom: 12px;
  right: 12px;
  width: 56px;
  height: 56px;
  background: white;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  opacity: 0;
  transform: scale(0.8);
  transition: all 0.3s ease;
  z-index: 3;
  border: 2px solid var(--primary);
}

.logo-badge img {
  width: 38px;
  height: 38px;
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
  font-size: 14px;
  font-weight: 600;
  color: var(--dark);
  margin-bottom: 12px;
  line-height: 1.4;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.product-divider {
  height: 1px;
  background: var(--border);
  margin-bottom: 12px;
}

.product-seller {
  font-size: 12px;
  color: var(--gray);
  margin-bottom: 12px;
  display: flex;
  align-items: center;
  gap: 6px;
  font-weight: 500;
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
  padding: 4px 8px;
  background: var(--primary-light);
  border-radius: 4px;
}

.stock-info {
  color: var(--gray);
  font-weight: 600;
}

.no-results {
  grid-column: 1 / -1;
  text-align: center;
  padding: 80px 20px;
  color: var(--gray);
}

.no-results i {
  font-size: 3.5rem;
  margin-bottom: 16px;
  opacity: 0.3;
}

/* ==========================================
   RESPONSIVE
   ========================================== */

@media (max-width: 1200px) {
  .products-grid {
    grid-template-columns: repeat(3, 1fr);
  }
  
  .hero-title-international {
    font-size: 56px;
  }
}

@media (max-width: 1024px) {
  .hero-international {
    padding: 100px 0 70px;
  }

  .hero-title-international {
    font-size: 48px;
  }
}

@media (max-width: 768px) {
  .products-wrapper {
    grid-template-columns: 1fr;
  }

  .filter-sidebar {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    width: 100%;
    height: 100vh;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1000;
    border-radius: 0;
    overflow-y: auto;
  }

  .filter-sidebar.active {
    display: block;
  }

  .filter-sidebar > .filter-header,
  .filter-sidebar > .filter-content {
    background: white;
  }

  .filter-sidebar > .filter-header {
    position: sticky;
    top: 0;
    z-index: 10;
  }

  .close-filter {
    display: flex;
  }

  .filter-btn-mobile {
    display: flex;
  }

  .products-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
  }

  .hero-international {
    padding: 80px 0 60px;
  }

  .hero-title-international {
    font-size: 36px;
  }

  .hero-description-international {
    font-size: 16px;
  }
}

@media (max-width: 640px) {
  .sort-section {
    width: 100%;
    flex-direction: column;
    align-items: stretch;
  }

  .sort-select,
  .filter-btn-mobile {
    width: 100%;
  }

  .hero-title-international {
    font-size: 28px;
  }

  .breadcrumb-international {
    font-size: 11px;
    gap: 4px;
    padding: 6px 16px;
  }
}

@media (max-width: 480px) {
  .products-grid {
    gap: 12px;
  }
  
  .hero-title-international {
    font-size: 24px;
  }
  
  .hero-description-international {
    font-size: 14px;
  }
}
</style>
@endpush

@section('content')
<!-- Hero Section - International Corporate Style -->
<section class="hero-international">
  <div class="hero-gradient-overlay"></div>
  <div class="hero-pattern"></div>

  <div class="container">
    <div class="hero-content-international" data-aos="fade-up">
      <div class="breadcrumb-international">
        <a href="{{ route('home') }}">
          <i class="fas fa-home"></i> {{ __('messages.home') }}
        </a>
        <i class="fas fa-chevron-right"></i>
        <span class="active">{{ __('messages.products') }}</span>
      </div>

      <h1 class="hero-title-international">
        {{ __('messages.discover_our') }} <span class="highlight-text">{{ __('messages.products') }}</span>
      </h1>

    </div>
  </div>
</section>

<!-- Main Content -->
<div class="main-container">
    <div class="container-wide">
        <div class="products-wrapper">
            <!-- Clean Sidebar -->
            <aside class="filter-sidebar" id="filterSidebar">
                <div class="filter-header">
                    <h3>Filter</h3>
                    <button class="close-filter" id="closeFilter">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div class="filter-content">
                    <div class="filter-group">
                        <h4>KATEGORI</h4>
                        <div class="filter-options">
                            <label class="filter-checkbox">
                                <input type="checkbox" 
                                       {{ !$selectedCategory ? 'checked' : '' }}
                                       onchange="window.location.href='{{ route('product.index', ['sort' => request('sort', 'newest')]) }}'">
                                <span>Semua Produk</span>
                            </label>
                            @foreach($category as $kat)
                                @if(!empty($kat->slug))
                                    <label class="filter-checkbox">
                                        <input type="checkbox" 
                                               {{ $selectedCategory && $selectedCategory->slug == $kat->slug ? 'checked' : '' }}
                                               onchange="window.location.href='{{ route('filterByCategory', ['slug' => $kat->slug, 'sort' => request('sort', 'newest')]) }}'">
                                        <span>{{ $kat->name }}</span>
                                    </label>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="filter-group">
                        <h4>STOCK</h4>
                        <div class="filter-options">
                            <label class="filter-checkbox">
                                <input type="checkbox">
                                <span>Tersedia</span>
                            </label>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Products Section -->
            <section class="products-main">
                <div class="products-controls" data-aos="fade-up">
                    <button class="filter-btn-mobile" id="filterBtnMobile">
                        <i class="fas fa-filter"></i> Filter
                    </button>

                    <div class="sort-section">
                        <span class="product-count">
                            Menampilkan <strong>{{ $totalProduct }}</strong> produk
                        </span>

                        <select id="sortSelect" class="sort-select">
                            <option value="newest" {{ request('sort') == 'newest' || !request('sort') ? 'selected' : '' }}>Terbaru</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Nama A-Z</option>
                        </select>
                    </div>
                </div>

                <div class="products-grid" id="productsGrid">
                    @forelse($products as $product)
                        <a href="{{ route('product.show', $product->slug) }}" class="product-card-link">
                            <div class="product-card" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 12) * 50 }}">
                                <div class="product-image-wrapper">
                                    <img src="{{ asset($product->images->first()->images ?? 'https://via.placeholder.com/500x500/f3f4f6/107c10?text=Product') }}" 
                                         alt="{{ $product->name }}" 
                                         class="product-image"
                                         onerror="this.onerror=null; this.src='https://via.placeholder.com/500x500/f3f4f6/107c10?text=Product'">
                                    
                                    <div class="badge-container">
                                        @if($product->discount ?? false)
                                            <span class="discount-badge">-{{ $product->discount }}%</span>
                                        @endif
                                        @if($product->is_featured ?? false)
                                            <span class="featured-badge">Unggulan</span>
                                        @endif
                                    </div>
                                    
                                    <div class="logo-badge">
                                            <img src="{{ asset($company->logo ?? 'assets/img/logo.png') }}" alt="Umalo">
                                    </div>
                                </div>
                                
                                <div class="product-info">
                                    <h3 class="product-title">{{ $product->name }}</h3>
                                    <div class="product-divider"></div>
                                    <p class="product-seller">
                                        <i class="fas fa-store"></i>
                                        Umalo Official Store
                                    </p>
                                    <div class="product-meta">
                                        <span class="badge-official">
                                            <i class="fas fa-check-circle"></i> Official
                                        </span>
                                        @if($product->stock ?? false)
                                            <span class="stock-info">Stok: {{ $product->stock }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="no-results">
                            <i class="fas fa-box-open"></i>
                            <p>Produk tidak ditemukan</p>
                        </div>
                    @endforelse
                </div>

                @if($products->hasPages())
                    <div class="mt-4">
                        {{ $products->links() }}
                    </div>
                @endif
            </section>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
AOS.init({
    duration: 500,
    easing: "ease-out",
    once: true,
});

document.getElementById('sortSelect')?.addEventListener('change', function() {
    var sort = this.value;
    var url = new URL(window.location.href);
    url.searchParams.set('sort', sort);
    window.location.href = url.toString();
});

const filterBtnMobile = document.getElementById('filterBtnMobile');
const filterSidebar = document.getElementById('filterSidebar');
const closeFilter = document.getElementById('closeFilter');

filterBtnMobile?.addEventListener('click', () => {
    filterSidebar.classList.add('active');
    document.body.style.overflow = 'hidden';
});

closeFilter?.addEventListener('click', () => {
    filterSidebar.classList.remove('active');
    document.body.style.overflow = '';
});

filterSidebar?.addEventListener('click', (e) => {
    if (e.target === filterSidebar) {
        filterSidebar.classList.remove('active');
        document.body.style.overflow = '';
    }
});

document.querySelectorAll('.product-image').forEach((img) => {
    img.addEventListener('error', function() {
        this.src = 'https://via.placeholder.com/500x500/f3f4f6/107c10?text=Product';
    });
});
</script>
@endpush