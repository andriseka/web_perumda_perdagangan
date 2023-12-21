@extends('layouts.general')

@section('content')
    <div class="mb-4">
        <h3 class="fw-bolder">ORGANISASI PERUMDA JEPARA</h3>
    </div>

    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <div>
                        <h4 class="fw-bolder">Buat Organisasi</h4>
                    </div>
                    <form action="{{ url('/admin/organisasi/store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" placeholder="Tulis Nama" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jabatan</label>
                            <input type="text" placeholder="Tulis Jabatan" class="form-control" name="jabatan" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Motto</label>
                            <textarea placeholder="Tulis Motto" style="height: 80px" class="form-control" name="motto"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Foto</label>
                            <input id="image" type="file" accept="image/png, image/jpg, image/jpeg" class="form-control" name="photo" required>
                            <div id="image-preview" class="d-flex justify-content-center"></div>
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
                        <h4 class="fw-bolder">Data Organisasi</h4>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['data'] as $struktur)
                                    <tr>
                                        <td>{{ $struktur['no'] }}</td>
                                        <td>{{ $struktur['name'] }}</td>
                                        <td>{{ $struktur['jabatan'] }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a href="" class="btn btn-success btn-sm me-2" data-bs-toggle="modal" data-bs-target="#edit_{{ $struktur['id'] }}">Edit</a>
                                                <form action="{{ url('/admin/organisasi/delete', $struktur['id']) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="edit_{{ $struktur['id'] }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-sm modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title fw-bolder">
                                                        Edit Organisasi
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ url('/admin/organisasi/update',$struktur['id']) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('patch')
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label class="form-label">Nama</label>
                                                            <input type="text" placeholder="Tulis Nama" class="form-control" name="name" value="{{ $struktur['name'] }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Jabatan</label>
                                                            <input type="text" placeholder="Tulis Jabatan" class="form-control" name="jabatan" value="{{ $struktur['jabatan'] }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Motto</label>
                                                            <textarea placeholder="Tulis Motto" style="height: 80px" class="form-control" name="motto">{{ $struktur['motto'] }}</textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Foto</label>
                                                            <input id="image_new" type="file" accept="image/png, image/jpg, image/jpeg" class="form-control" name="photo">
                                                            <div id="image-preview-new" class="d-flex justify-content-center">
                                                                <img src="{{ $struktur['photo'] }}" alt="" style="width: 180px; height: 180px; box-shadow: 1px 1px 5px #00000038;" class="rounded-circle mt-2">
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

        imagePreview.innerHTML = "<img src='"+ imageSrc +"' class='rounded-circle mt-2' style='width: 180px; height: 180px; box-shadow: 1px 1px 5px #00000038;' />"
    })

    let imageNew = document.querySelectorAll("#image_new");
    let imagePreviewNew = document.querySelectorAll("#image-preview-new");

    for (let i = 0; i < imageNew.length; i++) {
        imageNew[i].addEventListener("change", function(e) {
            let file  = this.files[0];
            let imageSrc = URL.createObjectURL(file);

            imagePreviewNew[i].innerHTML =  "<img src='"+ imageSrc +"' class='rounded-circle mt-2' style='width: 180px; height: 180px; box-shadow: 1px 1px 5px #00000038;' />"
        })
    }

</script>
@endsection
