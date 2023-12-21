@extends('layouts.general')

@section('content')
    <div class="mb-4">
        <h3 class="fw-bolder">DAFTAR KERJASAMA</h3>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%">No</th>
                            <th>Nama Kerjasama</th>
                            <th class="text-center" style="width: 15%">Gambar</th>
                            <th class="text-center" style="width: 20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['data'] as $cooperation)
                            <tr>
                                <td class="text-center">{{ $cooperation['no'] }}</td>
                                <td>{{ $cooperation['name'] }}</td>
                                <td class="text-center">
                                    @if ($cooperation['image'] !== null)
                                        <a href="{{ $cooperation['image'] }}" target="_blank">lihat gambar</a>
                                    @else
                                        <span>lihat gambar</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ url('/admin/cooperation/edit', $cooperation['slug']) }}" class="btn btn-success btn-sm me-2">Edit</a>
                                        <form action="{{ url('/admin/cooperation/delete', $cooperation['slug']) }}" method="POST" enctype="multipart/form-data">
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
                    <span>Total : {{ $data['pagination']['total'] }} Kerjasama</span>
                </div>
            </div>
        </div>
    </div>
@endsection
