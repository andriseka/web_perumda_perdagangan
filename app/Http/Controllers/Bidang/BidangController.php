<?php

namespace App\Http\Controllers\Bidang;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BidangController extends Controller
{
    protected $bidang;

    public function __construct(Bidang $bidang)
    {
        $this->bidang = $bidang;
    }

    public function index()
    {
        $data = $this->bidang->getData();
        return view('bidang.index', compact('data'));
    }

    public function create()
    {
        return view('bidang.create');
    }

    public function store(Request $request)
    {
        $store = $this->bidang->storeData($request->all());
        if ($store['status'] === 201) {
            Alert::toast('Data berhasil disimpan', 'success');
            return redirect('/admin/bidang');
        }

        if ($store['status'] === 400) {
            Alert::toast('Periksa kembali data Anda', 'error');
            return back()->withInput()->withErrors($store['message']);
        }
    }

    public function edit($slug)
    {
        $bidang = $this->bidang->getDetail($slug)['data'];
        return view('bidang.edit', compact('bidang'));
    }

    public function update(Request $request, $slug)
    {
        try {
            $update = $this->bidang->updateData($request->all(), $slug);

            if ($update['status'] === 200) {
                Alert::toast('Data berhasil diupdate', 'success');
                return redirect('/admin/bidang');
            }

            if ($update['status'] === 400) {
                Alert::toast('Periksa kembali data Anda', 'error');
                return back()->withErrors($update['message']);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function delete($slug)
    {
        $delete = $this->bidang->deleteData($slug);
        if ($delete['status'] === 200) {
            Alert::toast('Data berhasil dihapus', 'success');
            return back();
        }
    }
}
