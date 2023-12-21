<?php

namespace App\Http\Controllers\Cooperation;

use App\Http\Controllers\Controller;
use App\Models\Cooperation;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CooperationController extends Controller
{
    protected $cooperation;

    public function __construct(Cooperation $cooperation)
    {
        $this->cooperation = $cooperation;
    }

    public function index()
    {
        $data = $this->cooperation->getData();
        return view('cooperation.index', compact('data'));
    }

    public function create()
    {
        return view('cooperation.create');
    }

    public function store(Request $request)
    {
        try {
            $store = $this->cooperation->storeData($request->all());
            if ($store['status'] === 201) {
                Alert::toast('Data berhasil disimpan', 'success');
                return redirect('/admin/cooperation');
            }
            if ($store['status'] === 400) {
                Alert::toast('Periksa kembali data Anda', 'error');
                return back()->withInput()->withErrors($store['message']);
            }
        } catch (\Throwable $th) {

        }
    }

    public function edit($slug)
    {
        $cooperation = $this->cooperation->getDetail($slug)['data'];
        return view('cooperation.edit', compact('cooperation'));
    }

    public function update(Request $request, $slug)
    {
        try {
            $update = $this->cooperation->updateData($request->all(), $slug);
            if ($update['status'] === 200) {
                Alert::toast('Data berhasil diupdate', 'success');
                return redirect('/admin/cooperation');
            }

            if ($update['status'] === 400) {
                Alert::toast('Periksa kembali data Anda', 'error');
                return back()->withErrors($update['message']);
            }
        } catch (\Throwable $th) {

        }
    }

    public function delete($slug)
    {
        $delete = $this->cooperation->deleteData($slug);
        if ($delete['status'] === 200) {
            Alert::toast('Data berhasil dihapus', 'success');
            return back();
        }
    }
}
