<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PartnerController extends Controller
{
    protected $partner;

    public function __construct(Partner $partner)
    {
        $this->partner = $partner;
    }

    public function index()
    {
        $data = $this->partner->getData();
        return view('partner.index', compact('data'));
    }

    public function store(Request $request)
    {
        try {
            $store = $this->partner->storeData($request->all());
            if ($store['status'] === 201) {
                Alert::toast('Data berhasil disimpan', 'success');
                return back();
            }

            if ($store['status'] === 400) {
                Alert::toast('Periksa kembali data Anda', 'error');
                return back()->withInput()->withErrors($store['message']);
            }
        } catch (\Throwable $th) {

        }
    }

    public function update(Request $request, $slug)
    {
       try {
            $update = $this->partner->updateData($request->all(), $slug);
            if ($update['status'] === 200) {
                Alert::toast('Data berhasil diupdate', 'success');
                return back();
            }

            if ($update['status'] === 400) {
                Alert::toast('Periksa kembali data Anda', 'error');
                return back();
            }
       } catch (\Throwable $th) {
            //throw $th;
       }
    }

    public function delete($slug)
    {
        $delete = $this->partner->deleteData($slug);
        if ($delete['status'] === 200) {
            Alert::toast('Data berhasil dihapus', 'success');
            return back();
        }
    }
}
