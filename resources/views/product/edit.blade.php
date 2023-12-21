@extends('layouts.general')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugin/summernote/summernote-lite.css') }}">
@endsection

@section('content')
    <div class="mb-4 d-flex justify-content-between items-conten-center">
        <div>
            <h3 class="fw-bolder">EDIT PRODUK</h3>
        </div>
        <div>
            <a href="{{ url('/admin/product') }}">Produk</a> / {{ $product['name']  }}
        </div>
    </div>

    <form action="{{ url('/admin/product/update', $product['slug']) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="row">
            <div class="col-md-8 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Judul Produk</label>
                            <input type="text" class="form-control" name="name" placeholder="Tulis Judul Produk" value="{{ $product['name'] }}" required >
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <textarea name="desc" id="summernote">{{ $product['desc'] }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select name="product_category_id" class="form-select">
                                @foreach ($categories as $category)
                                    <option value="{{ $category['id'] }}"
                                        @if ($category['id'] === (int)$product['product_category_id'])
                                            selected
                                        @endif
                                    >{{ $category['name'] }}</option>
                                @endforeach
                            </select>
                            @error('product_category_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gambar Baru</label>
                            <input type="file" id="image" accept="image/png, image/jpg, image/jpeg" name="image" class="form-control">
                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div id="image-preview">
                                @if ($product['image'] !== null)
                                    <img src="{{ $product['image'] }}" class="rounded mt-2" style="width: 100%; height: 180px; box-shadow: 1px 1px 5px #00000038; ">
                                @endif
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success">Update Data</button>
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
            placeholder: 'Tulis Isi Produk',
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
