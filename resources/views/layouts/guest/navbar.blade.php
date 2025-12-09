    <body>

    @php
    $activeMetas = \App\Models\Meta::where('start_date', '<=', today())
        ->where('end_date', '>=', today())
        ->get()
        ->groupBy('type');
    $compro = \App\Models\CompanyParameter::first();
    @endphp

    <!-- ======================================= -->
    <!--               NAVBAR (DESKTOP)          -->
    <!-- ======================================= -->
    <nav class="navbar-umalo-dark">
        
        <!-- DESKTOP NAVBAR -->
        <div class="nav-desktop">
            <div class="nav-content">
                <a href="{{ route('home') }}" class="nav-link {{ Route::is('home') ? 'active' : '' }}">Home</a>
                <a href="{{ route('about') }}" class="nav-link {{ Route::is('about') ? 'active' : '' }}">About</a>
                <a href="{{ route('product.index') }}" class="nav-link {{ Route::is('product.index') ? 'active' : '' }}">Products</a>
                <a href="{{ route('activity') }}" class="nav-link {{ Route::is('activity') ? 'active' : '' }}">Activities</a>

                <a href="{{ route('home') }}" class="nav-logo">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Umalo Logo" />
                </a>

                <a href="{{ route('solutions.index') }}" class="nav-link {{ Route::is('solutions.*') ? 'active' : '' }}">Solution</a>
                <a href="{{ route('career.index') }}" class="nav-link {{ Route::is('career.index') ? 'active' : '' }}">Career</a>
                <a href="{{ route('contact') }}" class="nav-link {{ Route::is('contact') ? 'active' : '' }}">Contact</a>
                <a href="{{ route('faq') }}" class="nav-link {{ Route::is('faq') ? 'active' : '' }}">FAQs</a>
            </div>

            <div class="nav-actions">
                @guest
                    <a href="{{ route('login') }}" class="login-btn">Masuk</a>
                @endguest

                @auth
                    <div class="dropdown">
                        <button class="login-btn dropdown-toggle" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user"></i>
                            <span>{{ Str::limit(Auth::user()->nama_perusahaan, 15, '...') }}</span>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('portal') }}"><i class="fas fa-th-large me-2"></i>Portal</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
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

        <!-- ======================================= -->
        <!--             MOBILE TOP NAVBAR           -->
        <!-- ======================================= -->
        <div class="nav-mobile">
            <a href="{{ route('home') }}" class="nav-mobile-logo">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" />
            </a>

            <button class="hamburger" id="hamburger" aria-label="Menu">
                <span></span><span></span><span></span>
            </button>
        </div>

    </nav>

    <!-- ======================================= -->
    <!--       SIDEBAR FULL MENU (DRAWER)        -->
    <!-- ======================================= -->

    <div id="sidebarOverlay"></div>

    <div id="sidebarMenu">

        <!-- Header -->
        <div class="sb-header">
            <span class="sb-logo">
                <img src="{{ asset('assets/img/logo.png') }}" height="40">
            </span>
            <button id="sbClose">&times;</button>
        </div>

        <!-- Profile Section -->
        @auth
        <div class="sb-profile">
            <img src="{{ Auth::user()->profile_photo_url ?? asset('default.png') }}" class="sb-avatar">
            <div>
                <h4>{{ Auth::user()->name }}</h4>
                <p>{{ Auth::user()->email }}</p>
            </div>
        </div>
        @endauth

        <!-- Search -->
        <div class="sb-search">
            <input type="text" placeholder="Cari Product...">
            <button><i class="fas fa-search"></i></button>
        </div>

        <!-- Menu -->
    <div class="sb-menu">
        <a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a>
        <a href="{{ route('about') }}"><i class="fas fa-info-circle"></i> About</a>
        <a href="{{ route('product.index') }}"><i class="fas fa-box"></i> Products</a>
        <a href="{{ route('activity') }}"><i class="fas fa-calendar-alt"></i> Activities</a>
        <a href="{{ route('solutions.index') }}"><i class="fas fa-layer-group"></i> Solution</a>
        <a href="{{ route('career.index') }}"><i class="fas fa-briefcase"></i> Career</a>
        <a href="{{ route('contact') }}"><i class="fas fa-envelope"></i> Contact</a>
        <a href="{{ route('faq') }}"><i class="fas fa-question-circle"></i> FAQs</a>
    </div>


        <!-- Language -->
        <div class="sb-lang">
            <span>Bahasa</span>
            <div class="sb-lang-options">
                <a href="{{ LaravelLocalization::getLocalizedURL('id') }}">🇮🇩 Bahasa</a>
                <a href="{{ LaravelLocalization::getLocalizedURL('en') }}">🇬🇧 English</a>
            </div>
        </div>

        <!-- Logout -->
        @auth
        <div class="sb-logout">
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form2').submit();">
                <i class="fas fa-sign-out-alt"></i> Keluar
            </a>
            <form id="logout-form2" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
        </div>
        @endauth
    </div>

    <style>
        /* ============================================================
    IMPORT FONT
    ============================================================ */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');



    /* ============================================================
    BASE NAVBAR GENERAL STYLE
    ============================================================ */
.navbar-umalo-dark {
    width: 100%;
    position: fixed;   /* ✅ FIX: bukan absolute */
    top: 0;
    left: 0;
    z-index: 1000;
    padding: 0;        /* ✅ FIX: hapus padding penyebab gap */
    background: transparent;
}


    /* Desktop nav container */
    .nav-desktop {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 70px;
        width: 100%;
        padding: 0 30px;
        position: absolute;
        top: 0;
    }

    /* Grid menu desktop */
    .nav-content {
        display: grid;
        grid-template-columns: repeat(4, auto) auto repeat(4, auto);
        gap: 40px;
        align-items: center;
    }

    /* Navigation link */
    .nav-link {
        color: #fff !important;
        font-size: 14.5px;
        white-space: nowrap;
        letter-spacing: .3px;
        text-decoration: none;
        font-weight: 500;
        padding: 8px 0 !important;
        position: relative;
        text-shadow: 0 1px 3px rgba(0,0,0,.4);
        transition: .3s;
    }

    .nav-link::after {
        content: "";
        width: 0;
        height: 2px;
        position: absolute;
        bottom: 0;
        left: 0;
        background: #fff;
        transition: .3s;
    }

    .nav-link:hover::after,
    .nav-link.active::after {
        width: 100%;
    }

    /* Logo */
    .nav-logo img {
        height: 60px;
        transition: .35s;
        filter: drop-shadow(0 2px 8px rgba(0,0,0,.15)) brightness(1.1);
    }

    /* Action buttons (login / WA) */
    .nav-actions {
        position: absolute;
        right: 30px;
        top: 50%;
        transform: translateY(-50%);
        display: flex;
        gap: 16px;
    }

    /* Login button */
    .login-btn {
        background: #107c1040; !important;
        border: 1.5px solid #107c1040; !important;
        backdrop-filter: blur(12px);
        color: #fff !important;
        padding: 9px 26px;
        border-radius: 25px;
        font-weight: 600;
        transition: .3s;
    }

    .login-btn:hover {
        background: #107c1070 !important;
    }

    /* WhatsApp button */
    .btn-whatsapp {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items:center;
        justify-content:center;
        background: rgba(37,211,102,.2);
        border: 1.5px solid rgba(37,211,102,.35);
        color:#fff !important;
        transition:.3s;
    }

    .btn-whatsapp:hover {
        transform: scale(1.1);
    }



    /* ============================================================
    STICKY DESKTOP NAVBAR
    ============================================================ */
    .navbar-umalo-dark.sticky {
        position: fixed !important;
        background: rgba(255,255,255,.95) !important;
        backdrop-filter: blur(12px);
        height: 70px;
        padding: 0 !important;
        box-shadow: 0 4px 18px rgba(0,0,0,.08);
        display: flex;
        align-items: center;
    }

    .navbar-umalo-dark.sticky .nav-link {
        color: #1a1a1a !important;
        text-shadow: none;
    }

    .navbar-umalo-dark.sticky .nav-link::after {
        background: #107c10;
    }

    .navbar-umalo-dark.sticky .nav-logo img {
        height: 50px;
    }



/* ============================================================
MOBILE TOP NAVBAR (HEADER) - FIXED & RAPIH
============================================================ */
.nav-mobile {
    display: none;
    height: 64px;
    padding: 10px 18px;
    align-items: center;
    justify-content: space-between;
    background: #ffffff !important;
    box-shadow: 0 2px 10px rgba(0,0,0,.08);
    position: fixed;   /* ✅ GANTI dari sticky jadi fixed */
    top: 0;
    left: 0;
    width: 100%;
    z-index: 1001;
}


/* Logo kiri */
.nav-mobile-logo {
    display: flex;
    align-items: center;
}

.nav-mobile-logo img {
    height: 42px !important;
    object-fit: contain;
}

/* Hamburger kanan */
.hamburger {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    border: none;
    background: transparent;
    display: flex;
    flex-direction: column;
    gap: 5px;
    align-items: center;
    justify-content: center;
    transition: .2s;
    margin-left: auto; /* ✅ PAKSA KE KANAN */
}

.hamburger:hover {
    background: rgba(0,0,0,.05);
}

.hamburger span {
    width: 26px;
    height: 3px;
    background: #333 !important;
    border-radius: 2px;
}


    /* ============================================================
    SIDEBAR / DRAWER
    ============================================================ */
    #sidebarOverlay {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,.4);
        display: none;
        z-index: 9998;
    }

    #sidebarMenu {
        position: fixed;
        top: 0;
        left: -320px;
        width: 320px;
        height: 100%;
        background: #fff;
        padding: 22px;
        box-shadow: 2px 0 12px rgba(0,0,0,.08);
        z-index: 9999;
        transition: .3s ease;
        border-radius: 0 12px 12px 0;
    }

    #sidebarMenu.open { left: 0; }
    #sidebarOverlay.show { display: block; }

    /* Sidebar header */
    .sb-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    #sbClose {
        font-size: 32px;
        color: #444;
        background: none;
        border: none;
        cursor: pointer;
    }

    /* Sidebar profile */
    .sb-profile {
        display: flex;
        align-items: center;
        margin: 24px 0;
    }

    .sb-avatar {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        margin-right: 12px;
    }

    .sb-profile h4 {
        margin: 0;
        font-size: 17px;
        font-weight: 600;
    }

    .sb-profile p {
        margin: 2px 0 0;
        font-size: 13px;
        color: #777;
    }

    /* Search */
    .sb-search {
        display: flex;
        margin-bottom: 20px;
    }

    .sb-search input {
        flex: 1;
        padding: 11px 16px;
        border-radius: 30px 0 0 30px;
        border: 1px solid #ccc;
    }

    .sb-search button {
        width: 50px;
        background: #107c10;
        border: none;
        color: white;
        border-radius: 0 30px 30px 0;
    }

    /* Sidebar menu */
    .sb-menu a {
        display: block;
        padding: 14px 0;
        font-size: 15px;
        font-weight: 500;
        border-bottom: 1px solid rgba(0,0,0,.05);
        color: #111;
    }

    .sb-menu a i { width: 24px; }

    /* Language section */
    .sb-lang {
        margin-top: 20px;
        font-weight: 600;
    }

    .sb-lang-options a {
        display: inline-block;
        padding: 8px 16px;
        margin-right: 10px;
        background: #f4f4f4;
        border-radius: 8px;
        font-size: 13px;
    }

    /* Logout */
    .sb-logout a {
        display: block;
        padding: 14px 0;
        color: red;
        font-weight: 600;
        font-size: 15px;
    }

    .bn-item {
        color: #555;
        text-decoration: none;
        font-size: 12.5px;
        font-weight: 500;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 2px;
    }

    .bn-item i {
        font-size: 22px !important;
        transition: .2s;
    }

    .bn-item.active {
        color: #107c10;
        font-weight: 600;
    }

    .bn-item.active i {
        transform: scale(1.2);
    }



    /* ============================================================
    RESPONSIVE BREAKPOINT
    ============================================================ */
    @media (max-width: 1024px) {
        .nav-desktop { display: none !important; }
        .nav-mobile { display: flex !important; }
        body { padding-bottom: 75px !important; }
    }

    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function () {

        /* =======================================================
        *  STICKY DESKTOP NAVBAR
        * ======================================================= */
const navbar = document.querySelector(".navbar-umalo-dark");

window.addEventListener("scroll", function () {
    // ✅ HANYA JALAN DI DESKTOP
    if (window.innerWidth > 1024) {
        if (window.scrollY > 50) {
            navbar.classList.add("sticky");
        } else {
            navbar.classList.remove("sticky");
        }
    }
});




        /* =======================================================
        *  MOBILE HAMBURGER → OPEN SIDEBAR
        * ======================================================= */
        const hamburger = document.getElementById("hamburger");
        const sidebar = document.getElementById("sidebarMenu");
        const overlay = document.getElementById("sidebarOverlay");
        const sbClose = document.getElementById("sbClose");

        // Open sidebar
        hamburger.addEventListener("click", function () {
            sidebar.classList.add("open");
            overlay.classList.add("show");
            document.body.style.overflow = "hidden";
        });

        // Close sidebar (X button)
        sbClose.addEventListener("click", closeSidebar);

        // Close on overlay click
        overlay.addEventListener("click", closeSidebar);

        function closeSidebar() {
            sidebar.classList.remove("open");
            overlay.classList.remove("show");
            document.body.style.overflow = "auto";
        }



        /* =======================================================
        *  CLOSE SIDEBAR WHEN CLICKING LINKS INSIDE
        * ======================================================= */
        const sidebarLinks = sidebar.querySelectorAll("a");

        sidebarLinks.forEach(link => {
            link.addEventListener("click", function () {
                closeSidebar(); 
            });
        });



        /* =======================================================
        *  OPTIONAL: AUTO CLOSE SIDEBAR WHEN RESIZE TO DESKTOP
        * ======================================================= */
        window.addEventListener("resize", function () {
            if (window.innerWidth > 1024) {
                closeSidebar();
            }
        });



        /* =======================================================
        *  HAMBURGER ANIMATION (TURN INTO X)
        * ======================================================= */
        hamburger.addEventListener("click", function () {
            this.classList.toggle("active");
        });

    });

    </script>

    </body>