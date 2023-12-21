@extends('website.layouts.general')

@section('content')
<section class="breadscrumb-section" style="margin-top: 6rem">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                <div class="breadscrumb-contain">
                    <h2>{{ $data['category'] }}</h2>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/') }}">
                                    <i class="fa-solid fa-house"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <a href="{{ url('/award') }}">
                                    Penghargaan
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $data['category'] }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="blog-section section-b-space">
    <div class="container-fluid-lg">
        <div class="row g-4">
            <div class="col-xxl-9 col-xl-8 col-lg-7 order-lg-2">
                <div class="row g-4 ratio_65">
                    @foreach ($data['data'] as $award)
                        <div class="col-xxl-4 col-sm-6">
                            <div class="blog-box wow fadeInUp">
                                <div class="blog-image">
                                    <a href="{{ url('/award/detail', $award['slug']) }}">
                                        <img src="{{ $award['image'] }}"
                                            class="bg-img blur-up lazyload" alt="">
                                    </a>
                                </div>

                                <div class="blog-contain">
                                    <div class="blog-label">
                                        <span class="time">
                                            <i data-feather="clock"></i>
                                            <span>{{ $data['category'] }}</span>
                                        </span>
                                    </div>
                                    <a href="{{ url('/award/detail', $award['slug']) }}">
                                        <h3>{{ $award['title'] }}</h3>
                                    </a>
                                    <div>
                                        {!! $award['short_desc'] !!} ...
                                    </div>
                                    <button onclick="location.href = '{{ url('/award/detail', $award['slug']) }}';" class="blog-button">Read More
                                        <i class="fa-solid fa-right-long"></i></button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if ($data['pagination']['pagination'] === true)
                    <nav class="custome-pagination">
                        <ul class="pagination justify-content-center">
                            <li class="page-item">
                                <a class="page-link" href="?page={{ $data['pagination']['current_page'] - 1 }}" tabindex="-1">
                                    <i class="fa-solid fa-angles-left"></i> Sebelumnya
                                </a>
                            </li>

                            <li class="page-item">
                                <a class="page-link"  href="?page={{ $data['pagination']['current_page'] + 1 }}">
                                    Selanjutnya <i class="fa-solid fa-angles-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                @endif
            </div>

            <div class="col-xxl-3 col-xl-4 col-lg-5 order-lg-1">
                <div class="left-sidebar-box wow fadeInUp">
                    <div class="accordion left-accordion-box" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseTwo">
                                    Category
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse collapse show"
                                aria-labelledby="panelsStayOpen-headingTwo">
                                <div class="accordion-body p-0">
                                    <div class="category-list-box">
                                        <ul>
                                            @foreach ($category as $category)
                                                <li>
                                                    <a href="{{ url('/award/category', $category['slug']) }}">
                                                        <div class="category-name">
                                                            <h5>{{ $category['name'] }}</h5>
                                                            <span>{{ $category['count'] }}</span>
                                                        </div>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
