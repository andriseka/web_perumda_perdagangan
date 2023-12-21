@extends('layouts.general')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugin/summernote/summernote-lite.css') }}">
@endsection

@section('content')
    <div class="mb-4 d-flex justify-content-between items-conten-center">
        <div>
            <h3 class="fw-bolder">EDIT BIDANG BISNIS</h3>
        </div>
        <div>
            <a href="{{ url('/admin/bidang') }}">Bidang</a> / {{ $bidang['name']  }}
        </div>
    </div>

    <form action="{{ url('/admin/bidang/update', $bidang['slug']) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="row">
            <div class="col-md-8 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Bidang</label>
                            <input type="text" class="form-control" placeholder="Tulis Nama Bidang" name="name" value="{{ $bidang['name'] }}" required>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <textarea name="content" id="summernote">{{ $bidang['content'] }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Link Website</label>
                            <input type="text" class="form-control" value="{{ $bidang['link'] }}" name="link" placeholder="Link website ( Optional )">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gambar</label>
                            <input id="image" type="file" class="form-control" accept="image/png, image/jpg, image/jpeg" name="image">
                            <div id="image-preview">
                                @if ($bidang['image'] !== null)
                                    <img src="{{ asset('uploads/bidang/'.$bidang['image']) }}" class="rounded mt-2" alt="" style="width: 100%; height: 180px; box-shadow: 1px 1px 5px #00000038;">
                                @endif
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-success">Update Data</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('js')
    <script src="{{ asset('assets/plugin/summernote/summernote-lite.min.js') }}"></script>
    <script>
        $('#summernote').summernote({
            placeholder: 'Tulis Isi Konten',
            tabsize: 2,
            height: 350,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
            ]
        });
    </script>

    <script>
        let image = document.getElementById("image");
        let imagePreview = document.getElementById("image-preview");
        image.addEventListener("change", function() {
            let file = this.files[0];
            let imageSrc = URL.createObjectURL(file);

            imagePreview.innerHTML = "<img src='"+ imageSrc +"' class='rounded mt-2' style='width: 100%; height: 180px; box-shadow: 1px 1px 5px #00000038;' />"
        })
    </script>
@endsection
