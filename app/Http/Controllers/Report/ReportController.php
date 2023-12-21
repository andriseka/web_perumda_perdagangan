<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ReportController extends Controller
{
    protected $report;

    public function __construct(Report $report)
    {
        $this->report = $report;
    }

    public function index()
    {
        $data = $this->report->getData();
        return view('report.index', compact('data'));
    }

    public function store(Request $request)
    {
        $store = $this->report->storeData($request->all());
        if ($store['status'] === 201) {
            Alert::toast('Data berhasil disimpan', 'success');
            return back();
        }

        if ($store['status'] === 400) {
            Alert::toast('Periksa kembali data Anda', 'error');
            return back()->withInput()->withErrors($store['message']);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $update = $this->report->updateData($request->all(), $id);
            if ($update['status'] === 200) {
                Alert::toast('Data berhasil diupdate', 'success');
                return back();
            }

            if ($update['status'] === 400) {
                Alert::toast('Periksa kemabali data Anda', 'error');
                return back();
            }
        } catch (\Throwable $th) {

        }
    }

    public function delete($year)
    {
        $delete = $this->report->deleteData($year);
        if ($delete['status'] === 200) {
            Alert::toast('Data berhasil dihapus', 'success');
            return back();
        }
    }
}
