@extends('layouts.general')

@section('content')
    <div class="mb-4">
        <h3 class="fw-bolder">PARTNER</h3>
    </div>

    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <div>
                        <h4 class="fw-bolder">Buat Partner</h4>
                    </div>
                    <form action="{{ url('/admin/partner/store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama Partner</label>
                            <input type="text" name="name" class="form-control" placeholder="Tulis Nama Partner" value="{{ old('name') }}" required>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Link Informasi Kontak</label>
                            <textarea name="link" class="form-control" style="height: 80px" placeholder="Link Informasi Kontak ( Optional )"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Logo</label>
                            <input id="image" type="file" name="logo" class="form-control" accept="image/png, image/jpg, image/jpeg" required>
                            <div id="image-preview"></div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Simpan Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div>
                        <h4 class="fw-bolder">Daftar Partner</h4>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 5%">No</th>
                                    <th style="width: 35%">Partner</th>
                                    <th class="text-center" style="width: 15%">Link</th>
                                    <th class="text-center" style="width: 15%">Logo</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['data'] as $partner)
                                    <tr>
                                        <td>{{ $partner['no'] }}</td>
                                        <td>{{ $partner['name'] }}</td>
                                        <td class="text-center">
                                            <a href="{{ $partner['link'] }}" target="_blank">Link</a>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ $partner['logo'] }}" target="_blank">Lihat</a>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a href="" class="btn btn-success btn-sm me-2" data-bs-toggle="modal" data-bs-target="#{{ $partner['slug'] }}">Edit</a>
                                                <form action="{{ url('/admin/partner/delete', $partner['slug']) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="{{ $partner['slug'] }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-sm modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title fw-bolder">
                                                        Edit Partner
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ url('/admin/partner/update', $partner['slug']) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('patch')
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label class="form-label">Nama Partner</label>
                                                            <input type="text" name="name" class="form-control" placeholder="Tulis Nama Partner" value="{{ $partner['name'] }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Link Informasi Kontak</label>
                                                            <textarea name="link" class="form-control" style="height: 80px" placeholder="Link Informasi Kontak ( Optional )">{{ $partner['link'] }}</textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Logo</label>
                                                            <input id="image-new" type="file" name="logo" class="form-control" accept="image/png, image/jpg, image/jpeg">
                                                            <div id="image-update-preview"></div>
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
                            <span>Halaman {{ $data['pagination']['current_page'] }} </span>
                        </div>
                        @if ($data['pagination']['pagination'] === true)
                            <div>
                                <a href="?page={{ $data['pagination']['current_page'] - 1 }}" class="me-2">Sebelumnya</a>
                                <a href="?page={{ $data['pagination']['current_page'] + 1 }}">Selanjutnya</a>
                            </div>
                        @endif
                        <div>
                            <span>Total : {{ $data['pagination']['total'] }} Partner</span>
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

        imagePreview.innerHTML = "<img src='"+ imageSrc +"' class='rounded mt-2' style='width: 100%; height: 180px; box-shadow: 1px 1px 5px #00000038;' />"
    })

    let imageNew = document.querySelectorAll("#image-new");
    let imageUpdatePreview = document.querySelectorAll("#image-update-preview");

    for (let i = 0; i < imageNew.length; i++) {
        imageNew[i].addEventListener("change", function() {
            let newFile = this.files[0];
            let imageUpdateSrc = URL.createObjectURL(newFile);
            imageUpdatePreview[i].innerHTML = "<img src='"+ imageUpdateSrc +"' class='rounded mt-2' style='width: 100%; height: 180px; box-shadow: 1px 1px 5px #00000038;' />"
        })
    }

</script>
@endsection
