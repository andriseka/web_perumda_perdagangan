@extends('layouts.general')

@section('content')
    <div class="mb-4">
        <h3 class="fw-bolder">LAPORAN LABA RUGI</h3>
    </div>

    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <div>
                        <h4 class="fw-bolder">Buat Laporan Laba Rugi</h4>
                    </div>
                    <form action="{{ url('/admin/report/store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Tahun</label>
                            <input type="number" min="2000" name="year" placeholder="Tulis Tahun" class="form-control" value="{{ old('year') }}" required>
                            @error('year')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Total Anggaran</label>
                            <input type="text" id="currency" class="form-control" name="total_anggaran" placeholder="Rp. " value="{{ old('total_anggaran') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <textarea name="desc" style="height: 80px" class="form-control" placeholder="Tulis Keterangan">{{ old('desc') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Upload Excel Laporan Lab Rugi</label>
                            <input type="file" class="form-control" name="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                            @error('file')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
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
                        <h4 class="fw-bolder">Daftar Laporan Laba Rugi</h4>
                    </div>
                    <div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 5%">No</th>
                                        <th style="width: 25%">Tahun</th>
                                        <th>Total Anggaran</th>
                                        <th class="text-center">File</th>
                                        <th class="text-center" style="width: 20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['data'] as $report)
                                        <tr>
                                            <td class="text-center">{{ $report['no'] }}</td>
                                            <td>{{ $report['year'] }}</td>
                                            <td>Rp. {{ number_format($report['total_anggaran'], 0 , ',', '.') }}</td>
                                            <td class="text-center">
                                                @if ($report['file'] !== null)
                                                    <a href="{{ asset('uploads/report/'.$report['file']) }}" download="Laporan Laba Rugi Tahun {{ $report['year'] }}" >download</a>
                                                @else
                                                    <span title="file not found">download</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <a href="" class="btn btn-success btn-sm me-2" data-bs-toggle="modal" data-bs-target="#{{ $report['year'] }}">Edit</a>
                                                    <form action="{{ url('/admin/report/delete', $report['year']) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="{{ $report['year'] }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-sm modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title fw-bolder">
                                                            Edit Laporan Laba Rugi
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ url('/admin/report/update', $report['id']) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('patch')
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label class="form-label">Tahun</label>
                                                                <input type="number" min="2000" name="year" placeholder="Tulis Tahun" class="form-control" value="{{ $report['year'] }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Total Anggaran</label>
                                                                <input type="text" id="currencyedit" class="form-control" name="total_anggaran" placeholder="Rp. " value="Rp. {{ number_format($report['total_anggaran'],0,',','.') }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Keterangan</label>
                                                                <textarea name="desc" style="height: 80px" class="form-control" placeholder="Tulis Keterangan">{{ $report['desc'] }}</textarea>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Upload Excel Laporan Laba Rugi</label>
                                                                <input type="file" class="form-control" name="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
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
                                    <tr>
                                        <th colspan="2" class="text-center">Total</th>
                                        <th colspan="3">Rp. {{ number_format($data['total'], 0, ',', '.') }}</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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
                            <span>Total : {{ $data['pagination']['total'] }} Data</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        let currency = document.getElementById("currency");
        currency.addEventListener("keyup", function(e) {
            currency.value = currencyFormat(this.value, "Rp. ");
        })

        let currencyedit = document.querySelectorAll("#currencyedit");
        for (let i = 0; i < currencyedit.length; i++) {
            currencyedit[i].addEventListener("keyup", function(e) {
                currencyedit[i].value = currencyFormat(this.value, "Rp. ")
            })
        }

        function currencyFormat(number, prefix)
        {
            var number_string = number.replace(/[^,\d]/g, "").toString(),
                split = number_string.split(","),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? "." : "";
                rupiah += separator + ribuan.join(".");
            }

            rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
            return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
        }
    </script>
@endsection
