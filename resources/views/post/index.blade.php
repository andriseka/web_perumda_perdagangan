@extends('layouts.general')

@section('content')
    <div class="mb-4">
        <h3 class="fw-bolder">DAFTAR POSTINGAN</h3>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%">No</th>
                            <th style="width: 50%">Judul</th>
                            <th style="width: 25%">Kategori</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['data'] as $post)
                            <tr>
                                <td class="text-center">{{ $post['no'] }}</td>
                                <td>{{ $post['title'] }}</td>
                                <td>{{ $post['category'] }}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ url('/admin/post/edit', $post['slug']) }}" class="btn btn-success btn-sm me-3">Edit</a>
                                        <form action="{{ url('/admin/post/delete', $post['slug']) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm">Delete</button>
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
                    <span>Total : {{ $data['pagination']['total'] }} Postingan</span>
                </div>
            </div>
        </div>
    </div>
@endsection
