<?php

namespace App\Http\Controllers\Ads;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdsController extends Controller
{
    protected $ads;

    public function __construct(Ads $ads)
    {
        $this->ads = $ads;
    }

    public function index()
    {
        $data = $this->ads->getData();
        return view('ads.index', compact('data'));
    }

    public function store(Request $request)
    {
        try {
            $store = $this->ads->storeData($request->all());
            if ($store['status'] === 400) {
                Alert::toast('Periksa kembali data Anda', 'error');
                return back()->withInput()->withErrors($store['message']);
            }

            if ($store['status'] === 201) {
                Alert::toast('Data berhasil disimpan', 'success');
                return back();
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function update(Request $request, $slug)
    {
        try {
            $update = $this->ads->updateData($request->all(), $slug);

            if ($update['status'] === 400) {
                Alert::toast('Periksa kembali data Anda', 'error');
                return back()->withErrors($update['message']);
            }

            if ($update['status'] === 200) {
                Alert::toast('Data berhasil disimpan', 'success');
                return back();
            }
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function delete($slug)
    {
        $delete = $this->ads->deleteData($slug);
        if ($delete['status'] === 200) {
            Alert::toast('Data berhasil dihapus', 'success');
            return back();
        }
    }
}
