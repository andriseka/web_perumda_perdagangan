<header class="pb-md-4 pb-0">
    <div class="top-nav top-header sticky-header">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="navbar-top">
                        <button class="navbar-toggler d-xl-none d-inline navbar-menu-button" type="button"
                            data-bs-toggle="offcanvas" data-bs-target="#primaryMenu">
                            <span class="navbar-toggler-icon">
                                <i class="fa-solid fa-bars"></i>
                            </span>
                        </button>
                        <div class="nav-logo">
                            <a href="{{ url('/') }}" class="web-logo nav-logo">
                                <img src="{{ asset('assets/logo/logo.png') }}" class="img-fluid blur-up lazyload" style="width: 50%; " alt="">
                            </a>
                         </div>

                        <div class="middle-box">
                            <div class="search-box">
                                <form action="{{ url('/product/search') }}" method="GET">
                                    <div class="input-group">
                                        <input type="search" style="width: 50vw;" class="form-control" placeholder="Cari produk ..."
                                            aria-label="Recipient's username" aria-describedby="button-addon2" name="name">
                                        <button class="btn" type="submit" id="button-addon2">
                                            <i data-feather="search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="rightside-box ">
                            <div class="search-full">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i data-feather="search" class="font-light"></i>
                                    </span>
                                    <input type="text" class="form-control search-type"
                                        placeholder="Search Our Products ...">
                                    <span class="input-group-text close-search">
                                        <i data-feather="x" class="font-light"></i>
                                    </span>
                                </div>
                            </div>
                            <ul class="right-side-menu">
                                <li class="right-side">
                                    <div class="delivery-login-box">
                                        <div class="delivery-icon">
                                            <div class="search-box">
                                                <i data-feather="search"></i>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="right-side onhover-dropdown">
                                    <div class="delivery-login-box">
                                        <div class="delivery-icon">
                                            <div class="add-btn">
                                                <a class="btn theme-bg-color text-white" href="#">
                                                    <i class="fas fa-user me-3"></i> Login
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                <div class="header-nav">
                    <div class="header-nav-left">
                        <button class="dropdown-category">
                            <i data-feather="align-left"></i>
                            <span class="me-3">Menu</span>
                            <i class="fa fa-angle-down"></i>
                        </button>

                        <div class="category-dropdown">
                            <div class="category-title">
                                <h5>Menu/h5>
                                <button type="button" class="btn p-0 close-button text-content">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>

                            <ul class="category-list">
                                <li class="onhover-category-list">
                                    <a href="{{ url('/about') }}" class="category-name">
                                        <h6>Tentang Kami</h6>
                                    </a>
                                </li>
                                <li class="onhover-category-list">
                                    <a href="{{ url('/kerjasama') }}" class="category-name">
                                        <h6>Kerjasama</h6>
                                    </a>
                                </li>
                                <li class="onhover-category-list">
                                    <a href="{{ url('/product') }}" class="category-name">
                                        <h6>Produk</h6>
                                    </a>
                                </li>
                                <li class="onhover-category-list">
                                    <a href="{{ url('/news') }}" class="category-name">
                                        <h6>Berita</h6>
                                    </a>
                                </li>
                                <li class="onhover-category-list">
                                    <a href="{{ url('/contact') }}" class="category-name">
                                        <h6>Kontak</h6>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="header-nav-middle">
                        <div class="main-nav navbar navbar-expand-xl navbar-light navbar-sticky">
                            <div class="offcanvas offcanvas-collapse order-xl-2" id="primaryMenu">
                                <div class="offcanvas-header navbar-shadow">
                                    <h5>Menu</h5>
                                    <button class="btn-close lead" type="button" data-bs-dismiss="offcanvas"
                                        aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body">
                                    <ul class="navbar-nav">
                                        <li class="nav-item @if(Request::is('/')) active @endif">
                                            <a class="nav-link ps-xl-2 ps-0" href="{{ url('/') }}">Home</a>
                                        </li>

                                        <li class="nav-item @if(Request::is('about*')) active @endif">
                                            <a class="nav-link" href="{{ url('/about') }}" >Tentang Kami</a>
                                        </li>

                                        <li class="nav-item @if(Request::is('kerjasama*')) active @endif">
                                            <a class="nav-link" href="{{ url('/kerjasama') }}" >Kerjasama</a>
                                        </li>

                                        <li class="nav-item @if(Request::is('news*')) active @endif">
                                            <a class="nav-link" href="{{ url('/news') }}">Berita</a>
                                        </li>

                                        <li class="nav-item @if(Request::is('product*')) active @endif">
                                            <a class="nav-link" href="{{ url('/product') }}" >Produk</a>
                                        </li>

                                        <li class="nav-item @if(Request::is('contact*')) active @endif">
                                            <a class="nav-link" href="{{ url('/contact') }}">Kontak Kami</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn theme-bg-yellow text-white">
                        <i class="fa fa-youtube"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="mobile-menu d-md-none d-block mobile-cart">
    <ul>
        <li class="@if(Request::is('/')) active @endif">
            <a href="{{ url('/') }}">
                <i class="iconly-Home icli"></i>
                <span>Home</span>
            </a>
        </li>

        <li class="@if(Request::is('news')) active @endif">
            <a href="{{ url('/news') }}">
                <i class="iconly-Category icli "></i>
                <span>Berita</span>
            </a>
        </li>

        <li class="@if(Request::is('product')) active @endif">
            <a href="{{ url('/product') }}">
                <i class="iconly-Heart icli"></i>
                <span>Produk</span>
            </a>
        </li>

        <li class="@if(Request::is('contact')) active @endif">
            <a href="{{ url('/contact') }}">
                <i class="iconly-Call icli fly-cate"></i>
                <span>Kontak</span>
            </a>
        </li>
    </ul>
</div>

