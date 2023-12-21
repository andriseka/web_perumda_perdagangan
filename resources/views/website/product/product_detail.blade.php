@extends('website.layouts.general')

@section('content')
<section class="breadscrumb-section" style="margin-top: 6rem">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                <div class="breadscrumb-contain">
                    <h2>{{ $product['name'] }}</h2>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/') }}">
                                    <i class="fa-solid fa-house"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <a href="{{ url('/product') }}">
                                    Produk
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $product['name'] }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="product-section" style="margin-top: 3rem">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-xxl-9 col-xl-8 col-lg-7 wow fadeInUp">
                <div class="row g-4">
                    <div class="col-xl-6 wow fadeInUp">
                        <div class="product-left-box">
                            <div class="row g-2">
                                <div class="col-xxl-10 col-lg-12 col-md-10 order-xxl-2 order-lg-1 order-md-2">
                                    <div class="product-main-2 no-arrow">
                                        <div>
                                            <div class="slider-image">
                                                <img src="{{ $product['image'] }}" id="img-1"
                                                    data-zoom-image="{{ $product['image'] }}"
                                                    class="img-fluid image_zoom_cls-0 blur-up lazyload" alt="">
                                            </div>
                                        </div>
                                        <div>
                                            <div class="slider-image">
                                                <img src="{{ $product['image'] }}" id="img-1"
                                                    data-zoom-image="{{ $product['image'] }}"
                                                    class="img-fluid image_zoom_cls-0 blur-up lazyload" alt="">
                                            </div>
                                        </div>
                                        <div>
                                            <div class="slider-image">
                                                <img src="{{ $product['image'] }}" id="img-1"
                                                    data-zoom-image="{{ $product['image'] }}"
                                                    class="img-fluid image_zoom_cls-0 blur-up lazyload" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xxl-2 col-lg-12 col-md-2 order-xxl-1 order-lg-2 order-md-1">
                                    <div class="left-slider-image-2 left-slider no-arrow slick-top">
                                        <div>
                                            <div class="sidebar-image">
                                                <img src="{{ $product['image'] }}"
                                                    class="img-fluid blur-up lazyload" alt="">
                                            </div>
                                        </div>
                                        <div>
                                            <div class="sidebar-image">
                                                <img src="{{ $product['image'] }}"
                                                    class="img-fluid blur-up lazyload" alt="">
                                            </div>
                                        </div>
                                        <div>
                                            <div class="sidebar-image">
                                                <img src="{{ $product['image'] }}"
                                                    class="img-fluid blur-up lazyload" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="right-box-contain">
                            <h2 class="name">{{ $product['name'] }}</h2>
                            <div class="price-rating">
                                <h5 class="theme-color price">
                                    {{ $product['category'] }}
                                </h5>
                                <div class="product-rating custom-rate">
                                    <ul class="rating">
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="procuct-contain">
                                <p>
                                    {!! substr($product['desc'],0, 150) !!} ...
                                </p>
                            </div>

                            <div>
                                <div class="add-btn">
                                    <a class="btn theme-bg-color text-white" href="#">
                                        <i class="fab fa-whatsapp me-3"></i> Whatsapp
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="product-section-box">
                            <ul class="nav nav-tabs custom-nav" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                        data-bs-target="#description" type="button" role="tab"
                                        aria-controls="description" aria-selected="true">Description</button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="info-tab" data-bs-toggle="tab"
                                        data-bs-target="#info" type="button" role="tab" aria-controls="info"
                                        aria-selected="false">Additional info</button>
                                </li>
                            </ul>

                            <div class="tab-content custom-tab" id="myTabContent">
                                <div class="tab-pane fade show active" id="description" role="tabpanel"
                                    aria-labelledby="description-tab">
                                    <div class="product-description">
                                        {!! $product['desc'] !!}
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="info" role="tabpanel" aria-labelledby="info-tab">
                                    <div class="product-description">
                                        {!! $product['desc'] !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-3 col-xl-4 col-lg-5 d-none d-lg-block wow fadeInUp">
                <div class="right-sidebar-box">
                    <div class="vendor-box">
                        <div class="verndor-contain">
                            <div class="vendor-image">
                                <img src="{{ asset('assets/logo/logo.png') }}" class="blur-up lazyload" alt="">
                            </div>

                            <div class="vendor-name">
                                <h5 class="fw-500">Perumda Jepara</h5>

                                <div class="product-rating mt-1">
                                    <ul class="rating">
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>

                        <p class="vendor-detail">Noodles & Company is an American fast-casual
                            restaurant that offers international and American noodle dishes and pasta.</p>

                        <div class="vendor-list">
                            <ul>
                                <li>
                                    <div class="address-contact">
                                        <i data-feather="map-pin"></i>
                                        <h5>Address: <span class="text-content">1288 Franklin Avenue</span></h5>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Trending Product -->
                    <div class="pt-25">
                        <div class="category-menu">
                            <h3>Produk Terbaru</h3>

                            <ul class="product-list product-right-sidebar border-0 p-0">
                                @foreach ( $new_products as $new)
                                    <li>
                                        <div class="offer-product">
                                            <a href="{{ url('/product/detail', $new['slug']) }}" class="offer-image">
                                                <img src="{{ $new['image'] }}"
                                                    class="img-fluid blur-up lazyload" alt="">
                                            </a>

                                            <div class="offer-detail">
                                                <div>
                                                    <a href="{{ url('/product/detail', $new['slug']) }}">
                                                        <h6 class="name">{{ $new['name'] }}</h6>
                                                    </a>
                                                    <div>
                                                        {!! $new['short_desc'] !!} ...
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
