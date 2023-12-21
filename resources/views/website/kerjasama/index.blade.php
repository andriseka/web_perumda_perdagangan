@extends('website.layouts.general')

@section('content')
<section class="breadscrumb-section">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                <div class="breadscrumb-contain">
                    <h2>Kerjasama</h2>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/') }}">
                                    <i class="fa-solid fa-house"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Kerjasama</li>
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
                                <img src="../assets/images/inner-page/about-us/1.jpg"
                                    class="bg-img blur-up lazyload" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="fresh-image">
                            <div>
                                <img src="../assets/images/inner-page/about-us/2.jpg"
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
                            <h4>Kerjasama</h4>
                            <h2>Kerjasama</h2>
                        </div>

                        <div class="delivery-list">
                            <p class="text-content">Just a few seconds to measure your body temperature. Up to 5
                                users! The battery lasts up to 2 years. There are many variations of passages of
                                Lorem Ipsum available.We started in 2019 and haven't stopped smashing it since. A
                                global brand that doesn't sleep, we are 24/7 and always bringing something new with
                                over 100 new products dropping on the monhtly, bringing you the latest looks for
                                less.</p>
                        </div>

                        <div>
                            <div class="add-btn" style="width: 60%">
                                <a class="btn theme-bg-color text-white" href="#">
                                    <i class="fab fa-whatsapp me-3"></i> Whatsapp
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
