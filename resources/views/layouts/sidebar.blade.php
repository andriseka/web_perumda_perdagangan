<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ url('/dashboard') }}">
            <span class="align-middle d-flex justify-content-center">
                <img src="{{ asset('assets/logo/logo.png') }}" alt="" style="width: 60%; height: 70px">
            </span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Navigasi Menu
            </li>

            <li class="sidebar-item @if(Request::is('admin/dashboard')) active @endif">
                <a class="sidebar-link" href="{{ url('/admin/dashboard') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid align-middle me-2"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                    <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item @if(Request::is('admin/post*')) active @endif">
                <a data-bs-target="#post" data-bs-toggle="collapse" class="sidebar-link" aria-expanded="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout align-middle me-2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
                    <span class="align-middle">Berita</span>
                </a>
                <ul id="post" class="sidebar-dropdown list-unstyled collapse @if(Request::is('admin/post*')) show @endif" data-bs-parent="#sidebar" style="">
                    <li class="sidebar-item @if(Request::is('admin/post')) active @endif">
                        <a class="sidebar-link" href="{{ url('/admin/post') }}">Daftar Berita</a>
                    </li>
                    <li class="sidebar-item @if(Request::is('admin/post/create')) active @endif">
                        <a class="sidebar-link" href="{{ url('/admin/post/create') }}">Buat Berita</a>
                    </li>
                    <li class="sidebar-item @if(Request::is('admin/post/category*')) active @endif">
                        <a class="sidebar-link" href="{{ url('/admin/post/category') }}">Kategori</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item @if(Request::is('admin/product*')) active @endif">
                <a data-bs-target="#product" data-bs-toggle="collapse" class="sidebar-link" aria-expanded="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout align-middle me-2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
                    <span class="align-middle">Produk</span>
                </a>
                <ul id="product" class="sidebar-dropdown list-unstyled collapse @if(Request::is('admin/product*')) show @endif" data-bs-parent="#sidebar" style="">
                    <li class="sidebar-item @if(Request::is('admin/product')) active @endif">
                        <a class="sidebar-link" href="{{ url('/admin/product') }}">Daftar Produk</a>
                    </li>
                    <li class="sidebar-item @if(Request::is('admin/product/create')) active @endif">
                        <a class="sidebar-link" href="{{ url('/admin/product/create') }}">Buat Produk</a>
                    </li>
                    <li class="sidebar-item @if(Request::is('admin/product/category*')) active @endif">
                        <a class="sidebar-link" href="{{ url('/admin/product/category') }}">Kategori</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item @if(Request::is('admin/organisasi')) active @endif">
                <a class="sidebar-link" href="{{ url('/admin/organisasi') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid align-middle me-2"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                    <span class="align-middle">Organisasi</span>
                </a>
            </li>

            {{-- <li class="sidebar-item @if(Request::is('admin/rkap*')) active @endif">
                <a class="sidebar-link" href="{{ url('/admin/rkap') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text align-middle me-2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                    <span class="align-middle">RKAP</span>
                </a>
            </li>

            <li class="sidebar-item @if(Request::is('admin/report*')) active @endif">
                <a class="sidebar-link" href="{{ url('/admin/report') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-folder align-middle me-2"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
                    <span class="align-middle">Laporan Laba Rugi</span>
                </a>
            </li>

            <li class="sidebar-item @if(Request::is('admin/bidang*')) active @endif">
                <a data-bs-target="#bidang" data-bs-toggle="collapse" class="sidebar-link" aria-expanded="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bookmark align-middle me-2"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path></svg>
                    <span class="align-middle">Bidang Bisnis</span>
                </a>
                <ul id="bidang" class="sidebar-dropdown list-unstyled collapse @if(Request::is('admin/bidang*')) show @endif" data-bs-parent="#sidebar" style="">
                    <li class="sidebar-item @if(Request::is('admin/bidang')) active @endif">
                        <a class="sidebar-link" href="{{ url('/admin/bidang') }}">Daftar Bidang Bisnis</a>
                    </li>
                    <li class="sidebar-item @if(Request::is('admin/bidang/create')) active @endif">
                        <a class="sidebar-link" href="{{ url('/admin/bidang/create') }}">Buat Bidang Bisnis</a>
                    </li>
                </ul>
            </li>


            <li class="sidebar-item @if(Request::is('admin/award*')) active @endif">
                <a data-bs-target="#award" data-bs-toggle="collapse" class="sidebar-link" aria-expanded="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-award align-middle me-2"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>
                    <span class="align-middle">Penghargaan</span>
                </a>
                <ul id="award" class="sidebar-dropdown list-unstyled collapse @if(Request::is('admin/award*')) show @endif" data-bs-parent="#sidebar" style="">
                    <li class="sidebar-item @if(Request::is('admin/award')) active @endif">
                        <a class="sidebar-link" href="{{ url('/admin/award') }}">Daftar Penghargaan</a>
                    </li>
                    <li class="sidebar-item @if(Request::is('admin/award/create')) active @endif">
                        <a class="sidebar-link" href="{{ url('/admin/award/create') }}">Buat Penghargaan</a>
                    </li>
                    <li class="sidebar-item @if(Request::is('admin/award/category*')) active @endif">
                        <a class="sidebar-link" href="{{ url('/admin/award/category') }}">Kategori</a>
                    </li>
                </ul>
            </li> --}}

            {{-- <li class="sidebar-item @if(Request::is('admin/cooperation*')) active @endif">
                <a data-bs-target="#cooperation" data-bs-toggle="collapse" class="sidebar-link" aria-expanded="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-command align-middle me-2"><path d="M18 3a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3 3 3 0 0 0 3-3 3 3 0 0 0-3-3H6a3 3 0 0 0-3 3 3 3 0 0 0 3 3 3 3 0 0 0 3-3V6a3 3 0 0 0-3-3 3 3 0 0 0-3 3 3 3 0 0 0 3 3h12a3 3 0 0 0 3-3 3 3 0 0 0-3-3z"></path></svg>
                    <span class="align-middle">Kerjasama</span>
                </a>
                <ul id="cooperation" class="sidebar-dropdown list-unstyled collapse @if(Request::is('admin/cooperation*')) show @endif" data-bs-parent="#sidebar" style="">
                    <li class="sidebar-item @if(Request::is('admin/cooperation')) active @endif">
                        <a class="sidebar-link" href="{{ url('/admin/cooperation') }}">Daftar Kerjasama</a>
                    </li>
                    <li class="sidebar-item @if(Request::is('admin/cooperation/create')) active @endif">
                        <a class="sidebar-link" href="{{ url('/admin/cooperation/create') }}">Buat Kerjasama</a>
                    </li>
                </ul>
            </li> --}}

            {{-- <li class="sidebar-item @if(Request::is('admin/activity')) active @endif">
                <a class="sidebar-link" href="{{ url('/admin/activity') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar align-middle me-2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    <span class="align-middle">Kegiatan</span>
                </a>
            </li> --}}

            <li class="sidebar-item @if(Request::is('admin/ads')) active @endif">
                <a class="sidebar-link" href="{{ url('/admin/ads') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-link align-middle me-2"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
                    <span class="align-middle">Iklan</span>
                </a>
            </li>

            {{-- <li class="sidebar-item @if(Request::is('admin/partner')) active @endif">
                <a class="sidebar-link" href="{{ url('/admin/partner') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users align-middle me-2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    <span class="align-middle">Partner</span>
                </a>
            </li> --}}

            <li class="sidebar-item @if(Request::is('admin/slider')) active @endif">
                <a class="sidebar-link" href="{{ url('/admin/slider') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image align-middle me-2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                    <span class="align-middle">Slider</span>
                </a>
            </li>

        </ul>

        <div class="sidebar-cta">
            <div class="sidebar-cta-content">
                <strong class="d-inline-block mb-2">Hubungi Kami</strong>
                <div class="mb-3 text-sm">
                    Jika terjadi kendala dalam website. Silahkan hubungi kami
                </div>
                <div class="d-grid">
                    <a href="upgrade-to-pro.html" class="btn btn-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone-call align-middle me-2"><path d="M15.05 5A5 5 0 0 1 19 8.95M15.05 1A9 9 0 0 1 23 8.94m-1 7.98v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                        Call Me
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>
