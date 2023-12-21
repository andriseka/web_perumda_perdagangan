@extends('layouts.general')

@section('content')
    <div class="mb-4">
        <h3 class="fw-bolder">PRODUK KATEGORI</h3>
    </div>

    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <div>
                        <h4 class="fw-bolder">Buat Kategori Produk</h4>
                    </div>
                    <form action="{{ url('/admin/product/category/store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama Kategori</label>
                            <input type="text" name="name" class="form-control" placeholder="Tulis Nama Kategori" required value="{{ old('name') }}" >
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="desc" class="form-control" placeholder="Tulis Deskripsi" style="height: 100px"></textarea>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary">Simpan Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8 mb-3">
            <div class="card">
                <div class="card-body">
                    <div>
                        <h4 class="fw-bolder">Daftar Kategori</h4>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 5%;" class="text-center">No</th>
                                    <th style="width: 20%">Kategori</th>
                                    <th>Deskripsi</th>
                                    <th class="text-center" style="width: 20%">Jumlah</th>
                                    <th style="width: 10%" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $category)
                                    <tr>
                                        <td class="text-center">{{ $category['no'] }}</td>
                                        <td>{{ $category['name'] }}</td>
                                        <td>
                                            @if (strlen($category['desc']) > 30)
                                                {{ substr($category['desc'],0, 31) }} ...
                                            @else
                                                {{ $category['desc'] }}
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $category['count'] }} Produk</td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                @if ($category['slug'] !== 'uncategorized')
                                                    <a href="" class="btn btn-success btn-sm me-2" data-bs-toggle="modal" data-bs-target="#{{ $category['slug'] }}">Edit</a>
                                                    <form action="{{ url('/admin/product/category/delete', $category['slug']) }}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="{{ $category['slug'] }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-sm modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title fw-bolder">
                                                        Edit Kategori
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ url('/admin/product/category/update', $category['slug']) }}" method="POST">
                                                    @csrf
                                                    @method('patch')
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label class="form-label">Nama Kategori</label>
                                                            <input type="text" name="name" class="form-control" placeholder="Tulis Nama Kategori" required value="{{ $category['name'] }}" >
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Deskripsi</label>
                                                            <textarea name="desc" class="form-control" placeholder="Tulis Deskripsi" style="height: 100px">{{ $category['desc'] }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success">Update Data</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between">
                        <div>
                            <span>Halaman {{ $pagination['current_page'] }}</span>
                        </div>
                        @if ($pagination['pagination'] === true)
                            <div>
                                <a href="?page={{ $pagination['current_page'] - 1 }}" class="me-2">Sebelumnya</a>
                                <a href="?page={{ $pagination['current_page'] + 1 }}">Selanjutnya</a>
                            </div>
                        @endif
                        <div>
                            <span>Total : {{ $pagination['total'] }} Kategori</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
