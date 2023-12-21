@extends('website.layouts.general')

@section('content')
<section class="breadscrumb-section" style="margin-top: 6rem">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                <div class="breadscrumb-contain">
                    <h2>Bidang Bisnis</h2>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/') }}">
                                    <i class="fa-solid fa-house"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Bidang Bisnis</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="fresh-vegetable-section section-lg-space">
    <div class="container-fluid-lg">
        <div class="row gx-xl-5 gy-xl-0 g-3 ratio_148_1">
            <div class="col-xl-6 col-12">
                <div class="row g-sm-4 g-2">
                    <div class="col-6">
                        <div class="fresh-image-2">
                            <div>
                                <img src="{{ asset('user/banner/banner.png') }}"
                                    class="bg-img blur-up lazyload" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="fresh-image">
                            <div>
                                <img src="{{ asset('user/banner/banner.png') }}"
                                    class="bg-img blur-up lazyload" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-12">
                <div class="fresh-contain p-center-left">
                    <div>
                        <div class="review-title">
                            <h4>Bidang Bisnis</h4>
                            <h2>Bidang Bisnis Perusahaan</h2>
                        </div>

                        <div class="delivery-list">
                            <p class="text-content">Just a few seconds to measure your body temperature. Up to 5
                                users! The battery lasts up to 2 years. There are many variations of passages of
                                Lorem Ipsum available.We started in 2019 and haven't stopped smashing it since. A
                                global brand that doesn't sleep, we are 24/7 and always bringing something new with
                                over 100 new products dropping on the monhtly, bringing you the latest looks for
                                less.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="blog-section section-b-space">
    <div class="container-fluid-lg">
        <div class="row g-4">
            @foreach ( $bidang as $bidang)
                <div class="col-md-4">
                    <div class="blog-box wow fadeInUp">
                        <div class="blog-image">
                            <a href="blog-detail.html">
                                <img src="{{ $bidang['image'] }}" style="width: 100%; height: 210px" alt="">
                            </a>
                        </div>

                        <div class="blog-contain">
                            <a href="blog-detail.html">
                                <h3>{{ $bidang['name'] }}</h3>
                            </a>
                            <div>
                                {!! $bidang['content'] !!} ...
                            </div>
                            @if ($bidang['link'] !== null)
                                <a href="{{ $bidang['link'] }}" target="_blank" class="blog-button" style="width: 50%; align-items: center">
                                    Read More <i class="fa-solid fa-right-long"></i>
                                </a>
                            @else
                                <a href="{{ url('/bidang/detail', $bidang['slug']) }}" class="blog-button" style="width: 50%; align-items: center">
                                    Read More <i class="fa-solid fa-right-long"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
