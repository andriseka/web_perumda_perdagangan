@extends('website.layouts.general')


@section('content')
    <section class="home-section pt-2 ratio_50 mb-3">
        <div class="container-fluid-lg">
            <div class="row g-4">
                <div class="col-xl-9 col-lg-8 ratio_50_1">
                    <div class="home-slider product-wrapper">
                        @foreach ($slider as $slider)
                            <div>
                                <div class="team-box">
                                    <div class="team-iamge">
                                        <img src="{{ $slider['slider'] }}" class="slider-img-home">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 d-lg-inline-block d-none">
                    <div class="home-contain h-100 home-furniture">
                        <img src="{{ $homeAds['image'] }}" class="slider-img-home" alt="">
                        <div class="home-detail p-top-left home-p-sm feature-detail mend-auto">
                            <div>
                                <h2 class="mt-0 theme-color text-kaushan fw-normal mb-3">{{ $homeAds['name'] }}</h2>
                                <span class="text-white mb-3">{{ $homeAds['desc'] }}</span>
                                <a href="{{ $homeAds['link'] }}"
                                    class="shop-button btn btn-furniture mt-0 d-inline-block btn-md text-content">
                                    Lihat Detail <i class="fa-solid fa-right-long ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="pb-2">
        <div class="container-fluid-lg">
            <div class="row row-deck">
                <div class="col-md-4 mb-3">
                    <div class="card card-custome">
                        <div class="card-body">
                            <div class="title">
                                <h2>BERITA</h2>
                                <span class="title-leaf">
                                </span>
                            </div>
                            @foreach ($post as $posts)
                                <div class="card-content mb-4">
                                    <a href="{{ url('/news/detail', $posts['slug']) }}">
                                        <img src="{{ $posts['image'] }}" alt="" width="100%" height="200">
                                    </a>
                                    <div class="card-content__desc">
                                        Lorem ipsum, dolor sit amet consectetur adipisicing elit...
                                        <a href="{{ url('/news/detail', $posts['slug']) }}">Read More</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="card-footer card-footer__custome">
                            <a href="{{ url('/news') }}" class="more-news">Lihat berita lebih lanjut ... >>></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 mb-3">
                    <div class="card card-custome">
                        <div class="card-body">
                            <div class="title">
                                <h2>PRODUK</h2>
                                <span class="title-leaf">
                                </span>
                            </div>
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <div class="slider-7_1 shop-box no-arrow product-wrapper">
                                        @foreach ($category as $category)
                                            <div>
                                                <div class="shop-category-box">
                                                    <a href="{{ url('/product/category', $category['slug']) }}">
                                                        <div class="shop-category-image">
                                                            <img src="{{ asset('user/images/icon/icon pendidikan.png') }}" class="blur-up lazyload" alt="">
                                                        </div>
                                                        <div class="category-box-name">
                                                            <h6>{{ $category['name'] }}</h6>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row g-sm-4 g-3 row-cols-xxl-5 row-cols-xl-3 row-cols-lg-2 row-cols-md-3 row-cols-1 product-list-section">
                                        @foreach ($product as $product)
                                            <div>
                                                <div class="product-box-3 h-100 wow fadeInUp">
                                                    <div class="product-header">
                                                        <a href="{{ url('product-gallery/detail/product') }}">
                                                            <img src="{{ $product['image'] }}"
                                                                class="img-fluid blur-up lazyload img-product" alt="">
                                                        </a>
                                                        <div class="product-image">
                                                            <ul class="product-option">
                                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                                    <a href="{{ url('product/detail', $product['slug']) }}" data-bs-toggle="modal"
                                                                        data-bs-target="#view">
                                                                        <i data-feather="eye"></i>
                                                                    </a>
                                                                </li>

                                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                                                    <a href="{{ url('product/detail', $product['slug']) }}">
                                                                        <i data-feather="refresh-cw"></i>
                                                                    </a>
                                                                </li>

                                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                                                    <a href="{{ url('product/detail', $product['slug']) }}" class="notifi-wishlist">
                                                                        <i data-feather="heart"></i>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="product-footer px-3 py-2">
                                                        <div class="product-detail">
                                                            <a href="{{ url('product/detail', $product['slug']) }}">
                                                                <h5 class="name">{{ $product['name'] }}</h5>
                                                            </a>
                                                            <div class="product-rating mt-2">
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
                                                            </h5>
                                                            <div class="add-to-cart-box bg-white">
                                                                <a href="{{ url('product/detail', $product['slug']) }}" class="btn btn-add-cart addcart-button">
                                                                    Lihat Detail
                                                                    <span class="add-icon bg-light-gray">
                                                                        <i class="fa-solid fa-shopping-bag"></i>
                                                                    </span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer card-footer__custome">
                            <div class="col-12">
                                <div class="d-flex justify-content-center">
                                    <a href="{{ url('/product') }}" class="more-news">Lihat kegiatan lebih lanjut ... >>></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="blog-section pb-4">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-custome">
                        <div class="card-body">
                            <div class="title">
                                <h2>KEGIATAN</h2>
                                <span class="title-leaf">
                                </span>
                            </div>
                            <div class="row ratio_65">
                                <div class="col-12 mb-3">
                                    <div class="slider-3 shop-box no-arrow product-wrapper">
                                        @foreach ($post as $post)
                                            <div>
                                                <div class="blog-box wow fadeInUp">
                                                    <div class="blog-image">
                                                        <a href="{{ url('/news/detail', $post['slug']) }}">
                                                            <img src="{{ $post['image'] }}"
                                                                class="bg-img blur-up lazyload" alt="">
                                                        </a>
                                                    </div>

                                                    <div class="blog-contain">
                                                        <div class="blog-label">
                                                            <span class="time"><i data-feather="clock"></i> <span>{{ $post['category'] }}</span></span>
                                                        </div>
                                                        <a href="{{ url('/news/detail', $post['slug']) }}">
                                                            <h3>{{ $post['title'] }}</h3>
                                                        </a>
                                                        <button onclick="location.href = '{{ url('/news/detail', $post['slug']) }}';" class="blog-button">Read More
                                                            <i class="fa-solid fa-right-long"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="newsletter-section">
        <div class="container-fluid-lg">
            <div class="newsletter-box newsletter-box-2">
                <div class="newsletter-contain py-5" style="height: 250px">

                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        axios.get('/activity').then((resp) => {
            const result = resp.data;
            let dataEvent = [];
            for (let i = 0; i < result.length; i++) {
                dataEvent.push({
                    id: result[i]['id'],
                    name: result[i]['name'],
                    desc: result[i]['desc'],
                    start: result[i]['date'],
                    end: result[i]['date']
                })
            }

            new Calendar({
                id: '#color-calendar',
                calendarSize: 'small',
                primaryColor: '#000000a8;',
                eventsData: dataEvent,
                monthChanged: (currentDate, events) => {
                    let html = ""
                    for (let i = 0; i < events.length; i++) {
                        html += "<li class='d-block mb-3'>\
                                    <i class='fa fa-edit text-success'></i>\
                                    " + events[i]['name'] + " <br>\
                                    <span class='text-gray'>" + events[i]['name'] + "</span>\
                                </li>";
                    }

                    $("#list-event").html(html)
                }
            })
        })
    </script>
@endsection
