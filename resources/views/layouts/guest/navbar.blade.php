<body>

    @php
    $activeMetas = \App\Models\Meta::where('start_date', '<=', today())
        ->where('end_date', '>=', today())
        ->get()
        ->groupBy('type');

    $compro = \App\Models\CompanyParameter::first();
    @endphp

    <!-- New Navbar Component - Pertamina Style -->
    <nav class="navbar navbar-pertamina">
        <!-- Desktop Layout -->
        <div class="nav-desktop">
            <div class="nav-content">
                <!-- 4 Menu Kiri -->
                <a href="{{ route('home') }}" class="nav-link {{ Route::is('home') ? 'active' : '' }}">{{ __('messages.home') }}</a>
                <a href="{{ route('about') }}" class="nav-link {{ Route::is('about') ? 'active' : '' }}">{{ __('messages.about') }}</a>
                <a href="{{ route('product.index') }}" class="nav-link {{ Route::is('product.index') ? 'active' : '' }}">{{ __('messages.products') }}</a>
                <a href="{{ route('activity') }}" class="nav-link {{ Route::is('activity') ? 'active' : '' }}">{{ __('messages.activities') }}</a>

                <!-- Logo Tengah -->
                <a href="{{ route('home') }}" class="nav-logo">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Umalo Logo" class="logo-white" />
                </a>

                <!-- 4 Menu Kanan -->
                <a href="#" class="nav-link">Solution</a>
                <a href="#" class="nav-link">Career</a>
                <a href="{{ route('contact') }}" class="nav-link {{ Route::is('contact') ? 'active' : '' }}">{{ __('messages.contactUS') }}</a>
                <a href="{{ route('faq') }}" class="nav-link {{ Route::is('faq') ? 'active' : '' }}">{{ __('messages.faqs') }}</a>
            </div>

            <div class="nav-actions">
                <!-- Search Box -->
                <div class="search-box" id="searchBox">
                    <button class="search-toggle" id="searchToggle">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 17A8 8 0 1 0 9 1a8 8 0 0 0 0 16zM19 19l-4.35-4.35" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                    <input type="text" placeholder="Search..." class="search-input" id="searchInput" />
                </div>

                @guest
                    <!-- Login Button for Guest -->
                    <a href="{{ route('login') }}" class="login-btn">Masuk</a>
                @endguest

                @auth
                    <!-- User Dropdown for Authenticated Users -->
                    <div class="dropdown">
                        <a href="#" class="login-btn dropdown-toggle" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" style="display: inline-flex; align-items: center; gap: 8px;">
                            <i class="fas fa-user"></i>
                            <span>{{ Str::limit(Auth::user()->nama_perusahaan, 15, '...') ?? 'Your Company' }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                            <li>
                                <a class="dropdown-item" href="{{ route('portal') }}">
                                    <i class="fas fa-th-large me-2"></i>Portal
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth

                @guest
                    @if (!empty($compro->no_wa))
                        <!-- WhatsApp Button -->
                        <a href="https://wa.me/{{ preg_replace('/\D/', '', $compro->no_wa) }}?text={{ urlencode(__('messages.consult_text')) }}" 
                           class="btn-whatsapp" 
                           target="_blank">
                            <i class="fab fa-whatsapp fa-lg"></i>
                        </a>
                    @endif
                @endguest
            </div>
        </div>

        <!-- Mobile Layout -->
        <div class="nav-mobile">
            <a href="{{ route('home') }}" class="nav-logo-mobile">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Umalo Logo" />
            </a>

            <div class="nav-mobile-actions">
                @guest
                    <a href="{{ route('login') }}" class="login-btn-mobile">Masuk</a>
                @endguest

                @auth
                    <a href="{{ route('portal') }}" class="login-btn-mobile">Portal</a>
                @endauth
            </div>

            <button class="hamburger" id="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div class="mobile-menu" id="mobileMenu">
            <!-- Search di dalam mobile menu -->
            <div class="mobile-search-container">
                <input type="text" placeholder="Search..." class="mobile-search-input" />
            </div>

            <!-- Main Menu Items -->
            <a href="{{ route('home') }}" class="nav-link {{ Route::is('home') ? 'active' : '' }}">
                <i class="fas fa-home"></i>{{ __('messages.home') }}
            </a>
            <a href="{{ route('about') }}" class="nav-link {{ Route::is('about') ? 'active' : '' }}">
                <i class="fas fa-info-circle"></i>{{ __('messages.about') }}
            </a>
            <a href="{{ route('product.index') }}" class="nav-link {{ Route::is('product.index') ? 'active' : '' }}">
                <i class="fas fa-box"></i>{{ __('messages.products') }}
            </a>
            <a href="{{ route('activity') }}" class="nav-link {{ Route::is('activity') ? 'active' : '' }}">
                <i class="fas fa-calendar-alt"></i>{{ __('messages.activities') }}
            </a>
            <a href="#" class="nav-link">
                <i class="fas fa-lightbulb"></i>Solution
            </a>
            <a href="#" class="nav-link">
                <i class="fas fa-briefcase"></i>Career
            </a>
            <a href="{{ route('contact') }}" class="nav-link {{ Route::is('contact') ? 'active' : '' }}">
                <i class="fas fa-envelope"></i>{{ __('messages.contactUS') }}
            </a>
            <a href="{{ route('faq') }}" class="nav-link {{ Route::is('faq') ? 'active' : '' }}">
                <i class="fas fa-question-circle"></i>{{ __('messages.faqs') }}
            </a>
            
            @foreach ($activeMetas as $type => $metas)
                <div class="nav-link-dropdown">
                    <span class="dropdown-title">
                        <i class="fas fa-folder"></i>{{ ucfirst($type) }}
                    </span>
                    @foreach ($metas as $meta)
                        <a href="{{ route('member.meta.show', $meta->slug) }}" class="dropdown-item {{ Route::is('member.meta.show') && request()->slug == $meta->slug ? 'active' : '' }}">
                            {{ $meta->title }}
                        </a>
                    @endforeach
                </div>
            @endforeach

            <!-- Language Selector (Mobile) -->
            <div class="nav-link-dropdown">
                <span class="dropdown-title">
                    <i class="fas fa-globe-europe"></i>
                    @if(LaravelLocalization::getCurrentLocale() == 'id')
                        Bahasa
                    @elseif(LaravelLocalization::getCurrentLocale() == 'en')
                        English
                    @else
                        {{ LaravelLocalization::getCurrentLocaleNative() }}
                    @endif
                </span>
                <a href="{{ LaravelLocalization::getLocalizedURL('id') }}" class="dropdown-item">
                    <span class="me-2">🇮🇩</span>{{ __('messages.bahasa') }}
                </a>
                <a href="{{ LaravelLocalization::getLocalizedURL('en') }}" class="dropdown-item">
                    <span class="me-2">🇬🇧</span>{{ __('messages.english') }}
                </a>
            </div>

            @auth
                <a href="{{ route('portal') }}" class="login-btn-mobile-menu">
                    <i class="fas fa-th-large"></i>Portal
                </a>
                <a href="{{ route('logout') }}" 
                   class="login-btn-mobile-menu" 
                   style="background: #dc3545;"
                   onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">
                    <i class="fas fa-sign-out-alt"></i>Logout
                </a>
                <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @else
                <a href="{{ route('login') }}" class="login-btn-mobile-menu">
                    <i class="fas fa-sign-in-alt"></i>Masuk
                </a>
                @if (!empty($compro->no_wa))
                    <a href="https://wa.me/{{ preg_replace('/\D/', '', $compro->no_wa) }}?text={{ urlencode(__('messages.consult_text')) }}" 
                       class="login-btn-mobile-menu" 
                       style="background: #25D366;" 
                       target="_blank">
                        <i class="fab fa-whatsapp"></i>WhatsApp
                    </a>
                @endif
            @endguest
        </div>
    </nav>

    <script src="{{ asset('assets/js/navbar.js') }}"></script>

<style>
    /* Import Google Fonts - Poppins untuk navbar modern */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    /* ===== NAVBAR PERTAMINA STYLE - FULLY TRANSPARENT ===== */
    .navbar-pertamina {
        background: transparent !important;
        border-bottom: none !important;
        position: absolute !important;
        top: 0;
        left: 0;
        right: 0;
        width: 100%;
        z-index: 1000;
        padding: 15px 0;
        font-family: 'Poppins', 'Segoe UI', sans-serif;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Navbar saat di-scroll */
    .navbar-pertamina.scrolled {
        background: rgba(255, 255, 255, 0.98) !important;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1) !important;
        padding: 10px 0;
        border-bottom: none !important;
    }

    .navbar-pertamina.scrolled .nav-link,
    .navbar-pertamina.scrolled .search-toggle,
    .navbar-pertamina.scrolled .hamburger span {
        color: #1a1a1a !important;
    }

    .navbar-pertamina.scrolled .login-btn {
        background: linear-gradient(135deg, #107c10 0%, #0d6b0d 100%) !important;
        color: #fff !important;
        border-color: transparent !important;
    }

    /* ===== DESKTOP LAYOUT ===== */
    .nav-desktop {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 30px;
        height: 70px;
        width: 100%;
        position: relative;
    }

    .nav-content {
        display: grid;
        grid-template-columns: repeat(4, auto) auto repeat(4, auto);
        align-items: center;
        justify-content: center;
        gap: 40px;
        position: relative;
    }

    .nav-link {
        color: #ffffff !important;
        text-decoration: none;
        font-weight: 400;
        position: relative;
        transition: all 0.3s ease;
        white-space: nowrap;
        font-size: 14.5px;
        letter-spacing: 0.3px;
        padding: 8px 0 !important;
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
    }

    .nav-link::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: 0;
        height: 2px;
        width: 0;
        background: #ffffff;
        transition: all 0.3s ease;
    }

    .nav-link:hover,
    .nav-link.active {
        color: #ffffff !important;
        font-weight: 500;
    }

    .nav-link:hover::after,
    .nav-link.active::after {
        width: 100%;
    }

    .navbar-pertamina.scrolled .nav-link::after {
        background: #107c10;
    }

    .navbar-pertamina.scrolled .nav-link:hover,
    .navbar-pertamina.scrolled .nav-link.active {
        color: #107c10 !important;
    }

    .nav-logo {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: all 0.3s ease;
        margin: 0 20px;
    }

    .nav-logo img {
        height: 60px;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        filter: drop-shadow(0 2px 8px rgba(0, 0, 0, 0.15)) brightness(1.1);
    }
    
    .nav-logo:hover img {
        transform: scale(1.05);
    }

    .nav-actions {
        display: flex;
        align-items: center;
        gap: 16px;
        position: absolute;
        right: 30px;
        top: 50%;
        transform: translateY(-50%);
    }

    .search-box {
        position: relative;
        display: flex;
        align-items: center;
        height: 38px;
    }
    
    .search-toggle {
        background: rgba(255, 255, 255, 0.15) !important;
        border: 1px solid rgba(255, 255, 255, 0.3);
        cursor: pointer;
        color: #ffffff;
        padding: 0;
        border-radius: 50%;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        flex-shrink: 0;
        z-index: 2;
        position: relative;
    }

    .search-toggle:hover {
        background: rgba(255, 255, 255, 0.25) !important;
        border-color: rgba(255, 255, 255, 0.5);
        transform: scale(1.05);
    }

    .navbar-pertamina.scrolled .search-toggle {
        background: rgba(16, 124, 16, 0.1) !important;
        border-color: rgba(16, 124, 16, 0.3);
        color: #107c10;
    }

    .navbar-pertamina.scrolled .search-toggle:hover {
        background: rgba(16, 124, 16, 0.2) !important;
    }
    
    .search-input {
        position: absolute;
        right: 48px;
        width: 0;
        opacity: 0;
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        padding: 8px 15px;
        outline: none;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        color: #ffffff;
        height: 38px;
        z-index: 1;
    }
    
    .search-box.active .search-input {
        width: 220px;
        opacity: 1;
    }

    .search-input::placeholder {
        color: rgba(255, 255, 255, 0.7);
        font-weight: 300;
    }

    .navbar-pertamina.scrolled .search-input {
        color: #1a1a1a;
        background: rgba(255, 255, 255, 0.9);
        border-color: rgba(16, 124, 16, 0.2);
    }

    .navbar-pertamina.scrolled .search-input::placeholder {
        color: rgba(26, 26, 26, 0.5);
    }
    
    .login-btn {
        background: rgba(255, 255, 255, 0.2) !important;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3) !important;
        color: #fff !important;
        padding: 9px 26px;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        cursor: pointer;
        white-space: nowrap;
        font-size: 14px;
        letter-spacing: 0.4px;
        font-family: 'Poppins', sans-serif;
        flex-shrink: 0;
    }
    
    .login-btn:hover {
        background: rgba(255, 255, 255, 0.3) !important;
        border-color: rgba(255, 255, 255, 0.5) !important;
        transform: translateY(-2px);
        color: #fff !important;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
    }

    .nav-actions .dropdown-menu {
        border: 1px solid rgba(0, 0, 0, 0.1) !important;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15) !important;
        border-radius: 12px;
        padding: 10px 0;
        min-width: 200px;
        background: #ffffff !important;
        margin-top: 15px;
    }

    .nav-actions .dropdown-item {
        padding: 12px 20px;
        color: #1a1a1a !important;
        transition: all 0.2s ease;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        font-weight: 400;
    }

    .nav-actions .dropdown-item:hover {
        background: rgba(16, 124, 16, 0.08) !important;
        color: #107c10 !important;
        padding-left: 24px;
    }

    .nav-actions .dropdown-divider {
        margin: 8px 0;
        opacity: 0.15;
    }

    .btn-whatsapp {
        background: rgba(37, 211, 102, 0.2) !important;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(37, 211, 102, 0.3);
        color: #ffffff !important;
        width: 38px;
        height: 38px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        text-decoration: none;
        flex-shrink: 0;
    }

    .btn-whatsapp:hover {
        background: rgba(37, 211, 102, 0.35) !important;
        transform: scale(1.1);
        box-shadow: 0 6px 20px rgba(37, 211, 102, 0.3);
    }

    .navbar-pertamina.scrolled .btn-whatsapp {
        background: rgba(37, 211, 102, 0.15) !important;
        border-color: rgba(37, 211, 102, 0.4);
        color: #25D366 !important;
    }

    /* ===== MOBILE LAYOUT - SIMPLE & CLEAN ===== */
    .nav-mobile {
        display: none;
        grid-template-columns: 1fr auto auto;
        align-items: center;
        gap: 12px;
        height: 60px;
        padding: 0 16px;
    }
    
    .nav-logo-mobile {
        justify-self: start;
    }
    
    .nav-logo-mobile img {
        height: 40px;
        filter: drop-shadow(0 2px 6px rgba(0, 0, 0, 0.15)) brightness(1.1);
    }
    
    .nav-mobile-actions {
        display: flex;
        align-items: center;
        gap: 8px;
        justify-self: end;
    }
    
    .login-btn-mobile {
        background: rgba(255, 255, 255, 0.2) !important;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: #fff !important;
        padding: 8px 16px;
        border-radius: 18px;
        text-decoration: none;
        font-weight: 500;
        font-size: 12px;
        font-family: 'Poppins', sans-serif;
        white-space: nowrap;
    }

    .login-btn-mobile:hover {
        background: rgba(255, 255, 255, 0.3) !important;
    }
    
    .hamburger {
        background: rgba(255, 255, 255, 0.12);
        border: 1px solid rgba(255, 255, 255, 0.25);
        border-radius: 8px;
        cursor: pointer;
        padding: 8px;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        gap: 4px;
        justify-self: end;
    }

    .hamburger:hover {
        background: rgba(255, 255, 255, 0.2);
    }
    
    .hamburger span {
        width: 20px;
        height: 2px;
        background: #ffffff;
        transition: all 0.3s ease;
        border-radius: 2px;
    }
    
    .hamburger.active {
        background: rgba(255, 255, 255, 0.25);
    }
    
    .hamburger.active span:nth-child(1) {
        transform: rotate(45deg) translate(5px, 5px);
    }
    
    .hamburger.active span:nth-child(2) {
        opacity: 0;
    }
    
    .hamburger.active span:nth-child(3) {
        transform: rotate(-45deg) translate(5px, -5px);
    }

    /* Mobile Menu */
    .mobile-menu {
        display: none;
        flex-direction: column;
        position: fixed;
        top: 60px;
        left: 0;
        width: 100%;
        background: rgba(255, 255, 255, 0.98) !important;
        backdrop-filter: blur(15px);
        transition: transform 0.4s ease;
        transform: translateX(-100%);
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.15);
        max-height: calc(100vh - 60px);
        overflow-y: auto;
    }
    
    .mobile-menu.active {
        display: flex;
        transform: translateX(0);
    }

    /* Mobile Search Container */
    .mobile-search-container {
        padding: 16px 20px;
        border-bottom: 2px solid rgba(16, 124, 16, 0.1);
        background: rgba(16, 124, 16, 0.02);
    }

    .mobile-search-input {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid rgba(16, 124, 16, 0.2);
        border-radius: 22px;
        background: #ffffff;
        outline: none;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        color: #1a1a1a;
        transition: all 0.3s ease;
    }

    .mobile-search-input:focus {
        border-color: #107c10;
        box-shadow: 0 0 0 3px rgba(16, 124, 16, 0.1);
    }

    .mobile-search-input::placeholder {
        color: rgba(26, 26, 26, 0.5);
    }
    
    .mobile-menu .nav-link {
        padding: 15px 20px !important;
        color: #1a1a1a !important;
        text-decoration: none;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        font-weight: 400;
        font-family: 'Poppins', sans-serif;
        font-size: 15px;
        display: flex;
        align-items: center;
        transition: all 0.2s ease;
    }

    .mobile-menu .nav-link i {
        color: #107c10;
        opacity: 0.7;
        width: 24px;
        font-size: 17px;
        margin-right: 12px;
    }
    
    .mobile-menu .nav-link:hover,
    .mobile-menu .nav-link.active {
        color: #107c10 !important;
        background: rgba(16, 124, 16, 0.05);
        font-weight: 500;
    }

    .mobile-menu .nav-link:hover i,
    .mobile-menu .nav-link.active i {
        opacity: 1;
    }
    
    .login-btn-mobile-menu {
        margin: 16px 20px;
        padding: 14px;
        text-align: center;
        background: linear-gradient(135deg, #107c10 0%, #0d6b0d 100%) !important;
        color: #fff !important;
        border-radius: 24px;
        text-decoration: none;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        box-shadow: 0 4px 15px rgba(16, 124, 16, 0.25);
        font-size: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    /* Responsive */
    @media (max-width: 1400px) {
        .nav-content { gap: 32px; }
        .nav-link { font-size: 14px; }
        .nav-logo img { height: 56px; }
    }

    @media (max-width: 1200px) {
        .nav-content { gap: 24px; }
        .nav-link { font-size: 13.5px; }
        .nav-logo img { height: 52px; }
    }

    @media (max-width: 1024px) {
        .nav-desktop { display: none; }
        .nav-mobile { display: grid; }
    }

    /* Dropdowns */
    .nav-link-dropdown {
        padding: 15px 20px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .nav-link-dropdown .dropdown-title {
        font-weight: 600;
        color: #1a1a1a;
        display: flex;
        align-items: center;
        margin-bottom: 10px;
        font-family: 'Poppins', sans-serif;
        font-size: 15px;
    }

    .nav-link-dropdown .dropdown-title i {
        color: #107c10;
        width: 24px;
        font-size: 17px;
        margin-right: 12px;
    }

    .nav-link-dropdown .dropdown-item {
        padding: 10px 0 10px 44px;
        color: #555;
        text-decoration: none;
        display: block;
        font-size: 14px;
        font-family: 'Poppins', sans-serif;
        transition: all 0.2s ease;
    }

    .nav-link-dropdown .dropdown-item:hover,
    .nav-link-dropdown .dropdown-item.active {
        color: #107c10;
        font-weight: 500;
    }

    /* Scrollbar */
    .mobile-menu::-webkit-scrollbar {
        width: 4px;
    }

    .mobile-menu::-webkit-scrollbar-track {
        background: rgba(0, 0, 0, 0.03);
    }

    .mobile-menu::-webkit-scrollbar-thumb {
        background: rgba(16, 124, 16, 0.3);
        border-radius: 2px;
    }

    /* Scrolled state */
    .navbar-pertamina.scrolled .hamburger {
        background: rgba(16, 124, 16, 0.08);
        border-color: rgba(16, 124, 16, 0.2);
    }

    .navbar-pertamina.scrolled .hamburger span {
        background: #107c10;
    }

    .navbar-pertamina.scrolled .login-btn-mobile {
        background: linear-gradient(135deg, #107c10 0%, #0d6b0d 100%) !important;
        border-color: transparent;
    }

    .navbar-pertamina.scrolled .nav-logo-mobile img {
        filter: drop-shadow(0 2px 6px rgba(0, 0, 0, 0.1)) brightness(1);
    }
</style>

<script>
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar-pertamina');
        if (window.scrollY > 80) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
</script>

</body>