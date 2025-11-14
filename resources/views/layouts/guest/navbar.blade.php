<body>

    @php
    $activeMetas = \App\Models\Meta::where('start_date', '<=', today())
        ->where('end_date', '>=', today())
        ->get()
        ->groupBy('type');

    $compro = \App\Models\CompanyParameter::first();
    @endphp

    <!-- Navbar Component V1 - Dark Background / Hero Section -->
    <nav class="navbar navbar-pertamina-dark">
        <!-- DESKTOP NAVBAR - TETAP ABSOLUT TIDAK BERUBAH -->
        <div class="nav-desktop">
            <div class="nav-content">
                <a href="{{ route('home') }}" class="nav-link {{ Route::is('home') ? 'active' : '' }}">{{ __('messages.home') }}</a>
                <a href="{{ route('about') }}" class="nav-link {{ Route::is('about') ? 'active' : '' }}">{{ __('messages.about') }}</a>
                <a href="{{ route('product.index') }}" class="nav-link {{ Route::is('product.index') ? 'active' : '' }}">{{ __('messages.products') }}</a>
                <a href="{{ route('activity') }}" class="nav-link {{ Route::is('activity') ? 'active' : '' }}">{{ __('messages.activities') }}</a>

                <a href="{{ route('home') }}" class="nav-logo">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Umalo Logo" />
                </a>

                <a href="#" class="nav-link">Solution</a>
                <a href="{{ route('career.index') }}" class="nav-link {{ Route::is('career.index') ? 'active' : '' }}">Career</a>
                <a href="{{ route('contact') }}" class="nav-link {{ Route::is('contact') ? 'active' : '' }}">{{ __('messages.contactUS') }}</a>
                <a href="{{ route('faq') }}" class="nav-link {{ Route::is('faq') ? 'active' : '' }}">{{ __('messages.faqs') }}</a>
            </div>

            <div class="nav-actions">

                @guest
                    <a href="{{ route('login') }}" class="login-btn">Masuk</a>
                @endguest

                @auth
                    <div class="dropdown">
                        <button class="login-btn dropdown-toggle" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i>
                            <span>{{ Str::limit(Auth::user()->nama_perusahaan, 15, '...') ?? 'Your Company' }}</span>
                        </button>
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
                        <a href="https://wa.me/{{ preg_replace('/\D/', '', $compro->no_wa) }}" class="btn-whatsapp" target="_blank">
                            <i class="fab fa-whatsapp fa-lg"></i>
                        </a>
                    @endif
                @endguest
            </div>
        </div>

        <!-- MOBILE NAVBAR - STICKY -->
        <div class="nav-mobile">
            <a href="{{ route('home') }}" class="nav-mobile-logo">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" />
            </a>

            <button class="hamburger" id="hamburger" aria-label="Menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>

        <!-- MOBILE MENU DROPDOWN -->
        <div class="mobile-menu" id="mobileMenu">
            <a href="{{ route('home') }}" class="mobile-menu-link {{ Route::is('home') ? 'active' : '' }}">
                {{ __('messages.home') }}
            </a>
            <a href="{{ route('about') }}" class="mobile-menu-link {{ Route::is('about') ? 'active' : '' }}">
                {{ __('messages.about') }}
            </a>
            <a href="{{ route('product.index') }}" class="mobile-menu-link {{ Route::is('product.index') ? 'active' : '' }}">
                {{ __('messages.products') }}
            </a>
            <a href="{{ route('activity') }}" class="mobile-menu-link {{ Route::is('activity') ? 'active' : '' }}">
                {{ __('messages.activities') }}
            </a>
            <a href="#" class="mobile-menu-link">Solution</a>
            <a href="{{ route('career.index') }}" class="mobile-menu-link {{ Route::is('career.index') ? 'active' : '' }}">
                Career
            </a>
            <a href="{{ route('contact') }}" class="mobile-menu-link {{ Route::is('contact') ? 'active' : '' }}">
                {{ __('messages.contactUS') }}
            </a>
            <a href="{{ route('faq') }}" class="mobile-menu-link {{ Route::is('faq') ? 'active' : '' }}">
                {{ __('messages.faqs') }}
            </a>

            <div class="mobile-menu-divider"></div>

            @foreach ($activeMetas as $type => $metas)
                <div class="mobile-menu-section">
                    <div class="mobile-menu-title">{{ ucfirst($type) }}</div>
                    @foreach ($metas as $meta)
                        <a href="{{ route('member.meta.show', $meta->slug) }}" class="mobile-menu-sublink">
                            {{ $meta->title }}
                        </a>
                    @endforeach
                </div>
            @endforeach

            <div class="mobile-menu-divider"></div>

            <div class="mobile-menu-section">
                <div class="mobile-menu-title">Bahasa</div>
                <a href="{{ LaravelLocalization::getLocalizedURL('id') }}" class="mobile-menu-sublink">
                    🇮🇩 {{ __('messages.bahasa') }}
                </a>
                <a href="{{ LaravelLocalization::getLocalizedURL('en') }}" class="mobile-menu-sublink">
                    🇬🇧 {{ __('messages.english') }}
                </a>
            </div>

            <div class="mobile-menu-divider"></div>

            @guest
                <a href="{{ route('login') }}" class="mobile-menu-btn">
                    Masuk
                </a>
                @if (!empty($compro->no_wa))
                    <a href="https://wa.me/{{ preg_replace('/\D/', '', $compro->no_wa) }}" class="mobile-menu-btn whatsapp" target="_blank">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>
                @endif
            @endguest

            @auth
                <a href="{{ route('portal') }}" class="mobile-menu-btn">
                    Portal
                </a>
                <a href="{{ route('logout') }}" class="mobile-menu-btn logout" onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">
                    Logout
                </a>
                <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @endauth
        </div>
    </nav>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        /* ===== NAVBAR MAIN - FOR DARK BACKGROUND ===== */
        .navbar-pertamina-dark {
            width: 100%;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            padding: 15px 0;
            font-family: 'Poppins', 'Segoe UI', sans-serif;
            background: transparent !important;
            border-bottom: none !important;
        }

        /* ===== DESKTOP NAVBAR - UNTUK BACKGROUND GELAP/HERO ===== */
        .navbar-pertamina-dark .nav-desktop {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 30px;
            height: 70px;
            width: 100%;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            background: transparent;
        }

        .navbar-pertamina-dark .nav-content {
            display: grid;
            grid-template-columns: repeat(4, auto) auto repeat(4, auto);
            align-items: center;
            justify-content: center;
            gap: 40px;
            position: relative;
        }

        /* WARNA PUTIH UNTUK BACKGROUND GELAP */
        .navbar-pertamina-dark .nav-link {
            color: #ffffff !important;
            text-decoration: none;
            font-weight: 500;
            position: relative;
            transition: all 0.3s ease;
            white-space: nowrap;
            font-size: 14.5px;
            letter-spacing: 0.3px;
            padding: 8px 0 !important;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
        }

        .navbar-pertamina-dark .nav-link::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            height: 2px;
            width: 0;
            background: #ffffff;
            transition: all 0.3s ease;
        }

        .navbar-pertamina-dark .nav-link:hover,
        .navbar-pertamina-dark .nav-link.active {
            color: #ffffff !important;
            font-weight: 600;
        }

        .navbar-pertamina-dark .nav-link:hover::after,
        .navbar-pertamina-dark .nav-link.active::after {
            width: 100%;
        }

        .navbar-pertamina-dark .nav-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: all 0.3s ease;
            margin: 0 20px;
        }

        .navbar-pertamina-dark .nav-logo img {
            height: 60px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            filter: drop-shadow(0 2px 8px rgba(0, 0, 0, 0.15)) brightness(1.1);
        }

        .navbar-pertamina-dark .nav-logo:hover img {
            transform: scale(1.05);
        }

        .navbar-pertamina-dark .nav-actions {
            display: flex;
            align-items: center;
            gap: 16px;
            position: absolute;
            right: 30px;
            top: 50%;
            transform: translateY(-50%);
        }

        /* LIQUID GLASS EFFECT - PUTIH TRANSPARAN UNTUK BACKGROUND GELAP */
        .navbar-pertamina-dark .login-btn {
            background: rgba(255, 255, 255, 0.15) !important;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1.5px solid rgba(255, 255, 255, 0.25) !important;
            color: #fff !important;
            padding: 9px 26px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            cursor: pointer;
            white-space: nowrap;
            font-size: 14px;
            letter-spacing: 0.4px;
            font-family: 'Poppins', sans-serif;
            flex-shrink: 0;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .navbar-pertamina-dark .login-btn:hover {
            background: rgba(255, 255, 255, 0.25) !important;
            border-color: rgba(255, 255, 255, 0.4) !important;
            transform: translateY(-2px);
            color: #fff !important;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        }

        .navbar-pertamina-dark .nav-actions .dropdown-menu {
            border: 1px solid rgba(0, 0, 0, 0.1) !important;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15) !important;
            border-radius: 12px;
            padding: 10px 0;
            min-width: 200px;
            background: #ffffff !important;
            margin-top: 15px;
        }

        .navbar-pertamina-dark .nav-actions .dropdown-item {
            padding: 12px 20px;
            color: #1a1a1a !important;
            transition: all 0.2s ease;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            font-weight: 400;
        }

        .navbar-pertamina-dark .nav-actions .dropdown-item:hover {
            background: rgba(16, 124, 16, 0.08) !important;
            color: #107c10 !important;
            padding-left: 24px;
        }

        .navbar-pertamina-dark .nav-actions .dropdown-divider {
            margin: 8px 0;
            opacity: 0.15;
        }

        /* WHATSAPP BUTTON - LIQUID GLASS HIJAU */
        .navbar-pertamina-dark .btn-whatsapp {
            background: rgba(37, 211, 102, 0.2) !important;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1.5px solid rgba(37, 211, 102, 0.35);
            color: #ffffff !important;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            text-decoration: none;
            flex-shrink: 0;
            box-shadow: 0 4px 15px rgba(37, 211, 102, 0.15);
        }

        .navbar-pertamina-dark .btn-whatsapp:hover {
            background: rgba(37, 211, 102, 0.35) !important;
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(37, 211, 102, 0.3);
            border-color: rgba(37, 211, 102, 0.5);
        }

        /* ===== MOBILE NAVBAR - STICKY ===== */
        .navbar-pertamina-dark .nav-mobile {
            display: none;
            align-items: center;
            justify-content: space-between;
            padding: 12px 16px;
            height: 60px;
            width: 100%;
            position: sticky;
            top: 0;
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            z-index: 1000;
        }

        .navbar-pertamina-dark .nav-mobile-logo {
            height: 40px;
            display: flex;
            align-items: center;
            text-decoration: none;
            flex-shrink: 0;
        }

        .navbar-pertamina-dark .nav-mobile-logo img {
            height: 100%;
            width: auto;
            filter: drop-shadow(0 1px 3px rgba(0, 0, 0, 0.1)) brightness(1);
        }

        .navbar-pertamina-dark .hamburger {
            background: transparent;
            border: none;
            cursor: pointer;
            padding: 0;
            display: flex;
            flex-direction: column;
            gap: 5px;
            width: 44px;
            height: 44px;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .navbar-pertamina-dark .hamburger:hover {
            background: rgba(16, 124, 16, 0.08);
            border-radius: 8px;
        }

        .navbar-pertamina-dark .hamburger span {
            width: 24px;
            height: 2.5px;
            background: #1a1a1a;
            border-radius: 2px;
            transition: all 0.3s ease;
            display: block;
        }

        .navbar-pertamina-dark .hamburger.active span:nth-child(1) {
            transform: rotate(45deg) translate(7px, 7px);
        }

        .navbar-pertamina-dark .hamburger.active span:nth-child(2) {
            opacity: 0;
        }

        .navbar-pertamina-dark .hamburger.active span:nth-child(3) {
            transform: rotate(-45deg) translate(8px, -8px);
        }

        /* ===== MOBILE MENU ===== */
        .navbar-pertamina-dark .mobile-menu {
            display: none;
            position: fixed;
            top: 60px;
            left: 0;
            width: 100%;
            max-height: calc(100vh - 60px);
            background: white;
            overflow-y: auto;
            flex-direction: column;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            z-index: 999;
            animation: slideDown 0.3s ease;
        }

        .navbar-pertamina-dark .mobile-menu.active {
            display: flex;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .navbar-pertamina-dark .mobile-menu-link {
            display: block;
            padding: 14px 20px;
            color: #1a1a1a;
            text-decoration: none;
            font-size: 14px;
            font-weight: 400;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.2s ease;
        }

        .navbar-pertamina-dark .mobile-menu-link:hover,
        .navbar-pertamina-dark .mobile-menu-link.active {
            background: rgba(16, 124, 16, 0.05);
            color: #107c10;
            font-weight: 500;
            padding-left: 24px;
        }

        .navbar-pertamina-dark .mobile-menu-divider {
            height: 1px;
            background: rgba(0, 0, 0, 0.08);
            margin: 8px 0;
        }

        .navbar-pertamina-dark .mobile-menu-section {
            padding: 0;
        }

        .navbar-pertamina-dark .mobile-menu-title {
            padding: 12px 20px;
            font-size: 12px;
            font-weight: 600;
            color: #1a1a1a;
            background: rgba(16, 124, 16, 0.03);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .navbar-pertamina-dark .mobile-menu-sublink {
            display: block;
            padding: 12px 20px 12px 40px;
            color: #555;
            text-decoration: none;
            font-size: 13px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.03);
            transition: all 0.2s ease;
        }

        .navbar-pertamina-dark .mobile-menu-sublink:hover,
        .navbar-pertamina-dark .mobile-menu-sublink.active {
            background: rgba(16, 124, 16, 0.05);
            color: #107c10;
            font-weight: 500;
            padding-left: 48px;
        }

        .navbar-pertamina-dark .mobile-menu-btn {
            margin: 8px 16px;
            padding: 12px 16px;
            text-align: center;
            background: linear-gradient(135deg, #107c10 0%, #0d6b0d 100%);
            color: white !important;
            text-decoration: none;
            border-radius: 24px;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border: none;
            cursor: pointer;
        }

        .navbar-pertamina-dark .mobile-menu-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(16, 124, 16, 0.3);
        }

        .navbar-pertamina-dark .mobile-menu-btn.whatsapp {
            background: linear-gradient(135deg, #25D366 0%, #1FB040 100%);
        }

        .navbar-pertamina-dark .mobile-menu-btn.whatsapp:hover {
            box-shadow: 0 4px 15px rgba(37, 211, 102, 0.3);
        }

        .navbar-pertamina-dark .mobile-menu-btn.logout {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        }

        .navbar-pertamina-dark .mobile-menu-btn.logout:hover {
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1024px) {
            .navbar-pertamina-dark .nav-desktop {
                display: none;
            }

            .navbar-pertamina-dark .nav-mobile {
                display: flex;
            }
        }

        @media (max-width: 480px) {
            .navbar-pertamina-dark .nav-mobile {
                padding: 10px 12px;
                height: 55px;
            }

            .navbar-pertamina-dark .nav-mobile-logo {
                height: 36px;
            }

            .navbar-pertamina-dark .hamburger {
                width: 40px;
                height: 40px;
            }

            .navbar-pertamina-dark .hamburger span {
                width: 20px;
                height: 2px;
            }

            .navbar-pertamina-dark .mobile-menu {
                top: 55px;
                max-height: calc(100vh - 55px);
            }

            .navbar-pertamina-dark .mobile-menu-link {
                padding: 12px 16px;
                font-size: 13px;
            }

            .navbar-pertamina-dark .mobile-menu-link:hover,
            .navbar-pertamina-dark .mobile-menu-link.active {
                padding-left: 22px;
            }

            .navbar-pertamina-dark .mobile-menu-title {
                padding: 10px 16px;
                font-size: 11px;
            }

            .navbar-pertamina-dark .mobile-menu-sublink {
                padding: 10px 16px 10px 36px;
                font-size: 12px;
            }

            .navbar-pertamina-dark .mobile-menu-sublink:hover,
            .navbar-pertamina-dark .mobile-menu-sublink.active {
                padding-left: 44px;
            }

            .navbar-pertamina-dark .mobile-menu-btn {
                margin: 6px 12px;
                padding: 10px 14px;
                font-size: 12px;
            }
        }

        @media (max-width: 380px) {
            .navbar-pertamina-dark .nav-mobile {
                padding: 8px 10px;
            }

            .navbar-pertamina-dark .nav-mobile-logo {
                height: 32px;
            }

            .navbar-pertamina-dark .hamburger {
                width: 38px;
                height: 38px;
            }

            .navbar-pertamina-dark .hamburger span {
                width: 18px;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hamburger = document.getElementById('hamburger');
            const mobileMenu = document.getElementById('mobileMenu');

            // Hamburger toggle
            hamburger.addEventListener('click', function() {
                hamburger.classList.toggle('active');
                mobileMenu.classList.toggle('active');
                document.body.style.overflow = mobileMenu.classList.contains('active') ? 'hidden' : 'auto';
            });

            // Close menu saat klik link
            document.querySelectorAll('.mobile-menu-link, .mobile-menu-sublink, .mobile-menu-btn').forEach(item => {
                item.addEventListener('click', function() {
                    hamburger.classList.remove('active');
                    mobileMenu.classList.remove('active');
                    document.body.style.overflow = 'auto';
                });
            });

            // Close menu saat klik di luar
            document.addEventListener('click', function(e) {
                if (!hamburger.contains(e.target) && !mobileMenu.contains(e.target)) {
                    hamburger.classList.remove('active');
                    mobileMenu.classList.remove('active');
                    document.body.style.overflow = 'auto';
                }
            });
        });
    </script>

</body>