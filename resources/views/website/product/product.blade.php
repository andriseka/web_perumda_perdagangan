@extends('website.layouts.general')

@section('content')
<section class="breadscrumb-section" style="margin-bottom: 2rem;">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                <div class="breadscrumb-contain">
                    <h2>Produk</h2>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/') }}">
                                    <i class="fa-solid fa-house"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Produk</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-b-space shop-section">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                <div class="row g-sm-4 g-3 row-cols-xxl-5 row-cols-xl-4 row-cols-lg-2 row-cols-md-4 row-cols-1 product-list-section">
                    @foreach ($data['data'] as $product)
                        <div>
                            <div class="product-box-3 h-100 wow fadeInUp">
                                <div class="product-header">
                                    <a href="{{ url('product/detail', $product['slug']) }}">
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
                                        <span class="span-name">{{ $product['category'] }}</span>
                                        <a href="{{ url('product/detail', $product['slug']) }}">
                                            <h5 class="name">{{ $product['name'] }}</h5>
                                        </a>
                                        <p class="text-content mt-1 mb-2 product-content">Cheesy feet cheesy grin brie.
                                            Mascarpone cheese and wine hard cheese the big cheese everyone loves smelly
                                            cheese macaroni cheese croque monsieur.</p>
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
                                            <span>(5.0)</span>
                                        </div>
                                        <div>
                                            {!! $product['short_desc'] !!} ...
                                        </div>
                                        <div class="add-to-cart-box" style="background-color:#088450 ">
                                            <a href="{{ url('product/detail', $product['slug']) }}" class="btn btn-add-cart addcart-button text-white">
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
        </div>
    </div>
</section>
@endsection
