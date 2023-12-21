@extends('website.layouts.general')

@section('content')
<section class="breadscrumb-section" style="margin-top: 6rem">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                <div class="breadscrumb-contain">
                    <h2>{{ $cooperation['name'] }}</h2>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/') }}">
                                    <i class="fa-solid fa-house"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $cooperation['name'] }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="blog-section section-b-space" style="margin-top: 2rem">
    <div class="container-fluid-lg">
        <div class="row g-sm-4 g-3">
            <div class="col-xxl-12 col-xl-12 col-lg-12 ratio_50">
                <div class="blog-detail-image rounded-3 mb-4">
                    <img src="{{ $cooperation['image'] }}" class="image-detail-blog" alt="">
                    <div class="blog-image-contain">
                        <h2>{{ $cooperation['name'] }}</h2>
                    </div>
                </div>

                <div class="blog-detail-contain">
                    {!! $cooperation['content'] !!}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
