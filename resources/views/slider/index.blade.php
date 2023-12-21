@extends('layouts.general')

@section('content')
    <div class="mb-4">
        <h3 class="fw-bolder">SLIDER</h3>
    </div>

    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <div>
                        <h4 class="fw-bolder">Buat Slider</h4>
                    </div>
                    <form action="{{ url('/admin/slider/store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Gambar / Video Mp4</label>
                            <input id="upload" type="file" name="slider" class="form-control" accept="image/png, image/jpg, image/jpeg, video/mp4" required>
                            <div id="upload-preview"></div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Simpan Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @foreach ( $data['data'] as $slider)
            <div class="col-md-4 mb-3">
                @if ($slider['type'] === 'mp4')
                    <video src="{{ $slider['slider'] }}" autoplay muted class="rounded" style="width: 100%; height: 180px; box-shadow: 1px 1px 5px #00000038;"></video>
                @else
                    <img src="{{ $slider['slider'] }}" alt="" class="rounded" style="width: 100%; height: 180px; box-shadow: 1px 1px 5px #00000038;">
                @endif
                <div class="d-flex justify-content-center" style="margin-top: -12%">
                    <form action="{{ url('/admin/slider/delete', $slider['id']) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach

        <div class="col-md-12">
            <div class="d-flex justify-content-center">
                @if ($data['pagination']['pagination'] === true)
                    <a href="?page={{ $data['pagination']['current_page'] - 1 }}" class="me-2">Sebelumnya</a>
                    <a href="?page={{ $data['pagination']['current_page'] + 1 }}">Selanjutnya</a>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        let upload = document.getElementById("upload");
        let uploadPreview = document.getElementById("upload-preview");
        upload.addEventListener("change", function() {
            let file = this.files[0];
            let imageSrc = URL.createObjectURL(file);

            if (file.type === 'video/mp4') {
                uploadPreview.innerHTML = "<video src='"+ imageSrc +"' autoplay class='rounded mt-2' style='width: 100%; height: 180px; box-shadow: 1px 1px 5px #00000038;'></video>"
            } else {
                uploadPreview.innerHTML = "<img src='"+ imageSrc +"' class='rounded mt-2' style='width: 100%; height: 180px; box-shadow: 1px 1px 5px #00000038;' />"
            }


        })
    </script>
@endsection
