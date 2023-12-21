@extends('layouts.general')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugin/summernote/summernote-lite.css') }}">
@endsection

@section('content')
    <div class="mb-4">
        <h3 class="fw-bolder">BUAT POSTINGAN</h3>
    </div>

    <form action="{{ url('/admin/post/store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-8 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Judul Postingan</label>
                            <input type="text" class="form-control" name="title" placeholder="Tulis Judul Postingan" required >
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <textarea name="content" id="summernote"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select name="post_category_id" class="form-select">
                                @foreach ($categories as $category)
                                    <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                @endforeach
                            </select>
                            @error('post_category_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gambar</label>
                            <input type="file" id="image" accept="image/png, image/jpg, image/jpeg" name="image" class="form-control">
                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div id="image-preview"></div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Simpan Data</button>
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
            placeholder: 'Tulis Isi Postingan',
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
