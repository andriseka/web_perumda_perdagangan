<?php

namespace App\Http\Controllers\Rkap;

use App\Http\Controllers\Controller;
use App\Models\Rkap;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RkapController extends Controller
{
    protected $rkap;

    public function __construct(Rkap $rkap)
    {
        $this->rkap = $rkap;
    }

    public function index()
    {
        $data = $this->rkap->getData();
        return view('rkap.index', compact('data'));
    }

    public function store(Request $request)
    {
        $store = $this->rkap->storeData($request->all());
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
            $update = $this->rkap->updateData($request->all(), $id);
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
        $delete = $this->rkap->deleteData($year);
        if ($delete['status'] === 200) {
            Alert::toast('Data berhasil dihapus', 'success');
            return back();
        }
    }
}
