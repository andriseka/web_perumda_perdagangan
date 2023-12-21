@extends('website.layouts.general')

@section('content')
<section class="breadscrumb-section" style="margin-top: 6rem">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                <div class="breadscrumb-contain">
                    <h2>RKAP</h2>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/') }}">
                                    <i class="fa-solid fa-house"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">RKAP</li>
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
                            <h4>RKAP</h4>
                            <h2>Rencana Kerja dan Anggaran Perusahaan</h2>
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

<section class="order-table-section section-b-space">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12 container">
                <div class="table-responsive mb-3">
                    <table class="table order-tab-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th class="text-start">Keterangan</th>
                                <th class="text-start">Tahun</th>
                                <th class="text-start">Laba / Rugi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['data'] as $rkap)
                                <tr>
                                    <td>{{ $rkap['no'] }}</td>
                                    <td class="text-start">{{ $rkap['desc'] }}</td>
                                    <td class="text-start">{{ $rkap['year'] }}</td>
                                    <td class="text-start">Rp. {{ number_format($rkap['total_anggaran'],0,',','.') }}</td>
                                    <td>
                                        <a href="{{ asset('uploads/rkap/'.$rkap['file']) }}" target="_blank" download="Rkap Tahun {{ $rkap['year'] }}">Download</a>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td class="fw-bold">
                                    Total
                                </td>
                                <td></td>
                                <td></td>
                                <td class="text-start fw-bold">
                                    Rp. {{ number_format($data['total'],0,',','.') }}
                                </td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between">
                    <div>
                        <span>Halaman {{ $data['pagination']['current_page'] }}</span>
                    </div>
                    @if ($data['pagination']['pagination'] === true)
                        <div>
                            <a href="?page={{ $data['pagination']['current_page'] - 1 }}" class="me-2">Sebelumnya</a>
                            <a href="?page={{ $data['pagination']['current_page'] + 1 }}">Selanjutnya</a>
                        </div>
                    @endif
                    <div>
                        <span>Total : {{ $data['pagination']['total'] }} Data</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
