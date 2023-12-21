@extends('layouts.general')

@section('content')
    <div class="mb-4">
        <h3 class="fw-bolder">DAFTAR BIDANG BISNIS</h3>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%">No</th>
                            <th>Nama Bidang</th>
                            <th class="text-center" style="width: 15%">Link</th>
                            <th class="text-center" style="width: 15%">Gambar</th>
                            <th class="text-center" style="width: 20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['data'] as $bidang)
                            <tr>
                                <td>{{ $bidang['no'] }}</td>
                                <td>{{ $bidang['name'] }}</td>
                                <td class="text-center">
                                    <a href="{{ $bidang['link'] }}" target="_blank">link</a>
                                </td>
                                <td class="text-center">
                                    <a href="{{ $bidang['image'] }}" target="_blank">lihat</a>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ url('/admin/bidang/edit', $bidang['slug']) }}" class="btn btn-success btn-sm me-2">Edit</a>
                                        <form action="{{ url('/admin/bidang/delete', $bidang['slug']) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
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
                    <span>Total : {{ $data['pagination']['total'] }} Bidang</span>
                </div>
            </div>
        </div>
    </div>
@endsection
