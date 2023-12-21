@extends('layouts.general')

@section('content')
    <div class="mb-4">
        <h3 class="fw-bolder">IKLAN</h3>
    </div>

    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <div>
                        <h4 class="fw-bolder">Buat Iklan</h4>
                    </div>

                    <form action="{{ url('/admin/ads/store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama Iklan</label>
                            <input type="text" class="form-control" placeholder="Tulis Nama Iklan" name="name" required>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <textarea name="desc" style="height: 80px" class="form-control" placeholder="Tulis Keterangan" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Posisi Iklan</label>
                            <select name="type" class="form-select" required>
                                <option value="home">Home Banner</option>
                                <option value="sidebar">Home Sidebar</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Link Iklan</label>
                            <input type="text" class="form-control" placeholder="Tulis Link Iklan" name="link" >
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gambar</label>
                            <input id="image" type="file" class="form-control" accept="image/png, image/jpg, image/jpeg" name="image" >
                            <div id="image-preview"></div>
                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary">Simpan Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div>
                        <h4 class="fw-bolder">Daftar Iklan</h4>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th style="width: 50%">Nama</th>
                                    <th  class="text-center">Jenis</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['data'] as $ads)
                                    <tr>
                                        <td>{{ $ads['no'] }}</td>
                                        <td>{{ $ads['name'] }}</td>
                                        <td class="text-center">
                                            @if ($ads['type'] === 'home')
                                                Home Banner
                                            @else
                                                Home Sidebar
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a href="" class="btn btn-success btn-sm me-2" data-bs-toggle="modal" data-bs-target="#{{ $ads['slug'] }}">Edit</a>
                                                <form action="{{ url('/admin/ads/delete', $ads['slug']) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="{{ $ads['slug'] }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-sm modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title fw-bolder">
                                                        Edit Iklan
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ url('/admin/ads/update', $ads['slug']) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('patch')
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label class="form-label">Nama Iklan</label>
                                                            <input type="text" class="form-control" placeholder="Tulis Nama Iklan" name="name" value="{{ $ads['name'] }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Keterangan</label>
                                                            <textarea name="desc" style="height: 80px" class="form-control" placeholder="Tulis Keterangan" required>{{ $ads['desc'] }}</textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Posisi Iklan</label>
                                                            <select name="type" class="form-select" required>
                                                                <option value="home" @if($ads['type'] === 'home') selected @endif>Home Banner</option>
                                                                <option value="sidebar" @if($ads['type'] === 'sidebar') selected @endif>Home Sidebar</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Link Iklan</label>
                                                            <input type="text" class="form-control" placeholder="Tulis Link Iklan" value="{{ $ads['link'] }}" name="link" >
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Gambar</label>
                                                            <input id="image-new" type="file" class="form-control" accept="image/png, image/jpg, image/jpeg" name="image" >
                                                            <div id="image-update-preview">
                                                                <img src={{ $ads['image'] }} alt="" class="mt-2 rounded" style="width: 50%; height: 220px">
                                                            </div>
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
                            <span>Halaman {{ $data['pagination']['current_page'] }}</span>
                        </div>
                        @if ($data['pagination']['pagination'] === true)
                            <div>
                                <a href="?page={{ $data['pagination']['current_page'] - 1 }}" class="me-2">Sebelumnya</a>
                                <a href="?page={{ $data['pagination']['current_page'] + 1 }}">Selanjutnya</a>
                            </div>
                        @endif
                        <div>
                            <span>Total : {{ $data['pagination']['total'] }} Iklan</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
<script>
    let image = document.getElementById("image");
    let imagePreview = document.getElementById("image-preview");
    image.addEventListener("change", function() {
        let file = this.files[0];
        let imageSrc = URL.createObjectURL(file);

        imagePreview.innerHTML = "<img src='"+ imageSrc +"' class='rounded mt-2' style='width:50%; height: 220px; box-shadow: 1px 1px 5px #00000038;' />"
    })

    let imageNew = document.querySelectorAll("#image-new");
    let imageUpdatePreview = document.querySelectorAll("#image-update-preview");

    for (let i = 0; i < imageNew.length; i++) {
        imageNew[i].addEventListener("change", function() {
            let newFile = this.files[0];
            let imageUpdateSrc = URL.createObjectURL(newFile);
            imageUpdatePreview[i].innerHTML = "<img src='"+ imageUpdateSrc +"' class='rounded mt-2' style='width: 50%; height: 220px; box-shadow: 1px 1px 5px #00000038;' />"
        })
    }

</script>
@endsection
