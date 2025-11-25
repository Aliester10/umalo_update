@if (!$products->isEmpty())
<div class="products-section smooth-section">
    <div class="container">

        <div class="products-header text-center mb-5">
            <h4>{{ __('messages.our_products') }}</h4>
            <h1>{{ __('messages.best_products') }}</h1>
        </div>

        <div class="products-grid">
            @foreach ($products as $product)
                <a href="{{ route('product.show', $product->slug) }}" class="product-card">

                    <div class="product-image-wrapper">
                        <img
                            src="{{ asset($product->images->first()->images ?? 'assets/img/default_product.jpg') }}"
                            alt="{{ $product->name }}"
                            class="product-image"
                            loading="lazy"
                            decoding="async"
                            onerror="this.src='https://via.placeholder.com/400x300?text=No+Image';">

                        <div class="badge-container">
                            @if($product->discount)
                                <span class="discount-badge">-{{ $product->discount }}%</span>
                            @endif

                            @if($product->is_featured)
                                <span class="featured-badge">
                                    {{ $product->featured_label ?? 'Featured' }}
                                </span>
                            @endif
                        </div>

                        <div class="logo-badge">
                            <img
                                src="{{ asset($company->logo ?? 'assets/img/logo.png') }}"
                                alt="Company Logo"
                                loading="lazy"
                                decoding="async">
                        </div>
                    </div>

                    <div class="product-info">
                        <h5 class="product-title">{{ $product->name }}</h5>

                        <div class="product-divider"></div>

                        <p class="product-seller">
                            <i class="fas fa-store"></i>
                            {{ $company->company_name ?? 'Official Store' }}
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

        <div class="products-footer text-center">
            <a class="btn btn-primary btn-sm py-3 px-5" href="{{ route('product.index') }}">
                {{ __('messages.more_products') }}
            </a>
        </div>

    </div>
</div>
@endif
