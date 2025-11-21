<!-- Sidebar -->
<div class="sidebar" data-background-color="light">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="light">
            <a href="{{ route('dashboard') }}" class="logo">
                <img src="{{ asset('assets/img/logo.png') }}" alt="navbar brand" class="navbar-brand" width="120" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>

    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>Beranda</p>
                    </a>
                </li>

                <!-- Member Management -->
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Kelola Member</h4>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#member-management">
                        <i class="fas fa-user-friends"></i>
                        <p>Member</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="member-management">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('members.index') }}">
                                    <span class="sub-item">Semua Member</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Distributor Management -->
                <li class="nav-section">
                    <span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
                    <h4 class="text-section">Kelola Distributor</h4>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#distributor-management">
                        <i class="fas fa-users-cog"></i>
                        <p>Distributor</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="distributor-management">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('distributors.index') }}">
                                    <span class="sub-item">Semua Distributor</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Product Management -->
                <li class="nav-section">
                    <span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
                    <h4 class="text-section">Kelola Product</h4>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#product-management">
                        <i class="fas fa-shopping-cart"></i>
                        <p>Product</p>
                        <span class="caret"></span>
                    </a>

                    <div class="collapse" id="product-management">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('admin.product.index') }}">
                                    <span class="sub-item">Semua Product</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.category.index') }}">
                                    <span class="sub-item">Kategori Product</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Ticketing -->
                <li class="nav-section">
                    <span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
                    <h4 class="text-section">Tanggapi Tiket</h4>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#tiket-management">
                        <i class="fas fa-ticket-alt"></i>
                        <p>Tiket</p>
                        <span class="caret"></span>
                    </a>

                    <div class="collapse" id="tiket-management">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('admin.ticketing.index') }}">
                                    <span class="sub-item">Semua Tiket</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Quotation -->
                <li class="nav-section">
                    <span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
                    <h4 class="text-section">Tanggapi Quotation</h4>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#quotations-management">
                        <i class="fas fa-file-alt"></i>
                        <p>Quotation</p>
                        <span class="caret"></span>
                    </a>

                    <div class="collapse" id="quotations-management">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('admin.quotations.index') }}">
                                    <span class="sub-item">Semua Quotation</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- CONTENT MANAGEMENT -->
                <li class="nav-section">
                    <span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
                    <h4 class="text-section">Kelola Konten</h4>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#content-management">
                        <i class="fas fa-info-circle"></i>
                        <p>Meta & Konten</p>
                        <span class="caret"></span>
                    </a>

                    <div class="collapse" id="content-management">
                        <ul class="nav nav-collapse">

                            <li>
                                <a href="{{ route('Admin.Meta.index') }}">
                                    <span class="sub-item">Meta</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('admin.banner.index') }}">
                                    <span class="sub-item">Banner</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('Admin.Activity.index') }}">
                                    <span class="sub-item">Aktivitas</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('admin.solution.index') }}">
                                    <span class="sub-item">Solution</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('admin.faq.index') }}">
                                    <span class="sub-item">Pertanyaan</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('admin.brand-partner.index') }}">
                                    <span class="sub-item">Brand & Logo</span>
                                </a>
                            </li>

                            <!-- =============================== -->
                            <!-- NEW : ABOUT MANAGEMENT SECTION -->
                            <!-- =============================== -->
                            <li>
                                <a data-bs-toggle="collapse" href="#about-management">
                                    <span class="sub-item">About Us</span>
                                    <span class="caret"></span>
                                </a>

                                <div class="collapse" id="about-management">
                                    <ul class="nav nav-collapse">

                                        <li>
                                            <a href="{{ route('admin.team.index') }}">
                                                <span class="sub-item">Team Members</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{ route('admin.core.index') }}">
                                                <span class="sub-item">Core Values</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{ route('admin.process.index') }}">
                                                <span class="sub-item">Process Steps</span>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </li>
                            <!-- =============================== -->

                        </ul>
                    </div>
                </li>

                <!-- Career -->
                <li class="nav-section">
                    <span class="sidebar-mini-icon"><i class="fa fa-briefcase"></i></span>
                    <h4 class="text-section">Karir</h4>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.career.positions.index') }}">
                        <i class="fas fa-briefcase"></i>
                        <p>Buat Karir</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.career.applications.index') }}">
                        <i class="fas fa-envelope-open"></i>
                        <p>Lamaran Masuk</p>
                    </a>
                </li>

                <!-- FAQ -->
                <li class="nav-section">
                    <span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
                    <h4 class="text-section">Kelola FAQ</h4>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#faqs-management">
                        <i class="fas fa-question-circle"></i>
                        <p>FAQ</p>
                        <span class="caret"></span>
                    </a>

                    <div class="collapse" id="faqs-management">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('admin.faq.index') }}">
                                    <span class="sub-item">Semua FAQ</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Messages -->
                <li class="nav-section">
                    <span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
                    <h4 class="text-section">Kelola Pesan</h4>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#messages-management">
                        <i class="fas fa-comment"></i>
                        <p>Pesan</p>
                        <span class="caret"></span>
                    </a>

                    <div class="collapse" id="messages-management">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('messages.index') }}">
                                    <span class="sub-item">Semua Pesan</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Master Data -->
                <li class="nav-section">
                    <span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
                    <h4 class="text-section">Master Data</h4>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#parameter-management">
                        <i class="fas fa-file-alt"></i>
                        <p>Master Data</p>
                        <span class="caret"></span>
                    </a>

                    <div class="collapse" id="parameter-management">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('parameter.index') }}">
                                    <span class="sub-item">Data</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
