<?php

namespace App\Http\Controllers\Struktur;

use App\Http\Controllers\Controller;
use App\Models\Struktur;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class StrukturController extends Controller
{
    protected $struktur;

    public function __construct(Struktur $struktur)
    {
        $this->struktur = $struktur;
    }

    public function index()
    {
        $data = $this->struktur->getData();
        return view('struktur.index', compact('data'));
    }

    public function store(Request $request)
    {
       try {
            $store = $this->struktur->storeData($request->all());
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

    public function update(Request $request, $id)
    {
       try {
            $update = $this->struktur->updateData($request->all(), $id);
            if ($update['status'] === 200) {
                Alert::toast('Data berhasil diupdate', 'success');
                return back();
            }

            if ($update['status'] === 400) {
                Alert::toast('Periksa kembali data Anda', 'error');
                return back();
            }
       } catch (\Throwable $th) {

       }
    }

    public function delete($id)
    {
        $delete = $this->struktur->deleteData($id);
        if ($delete['status'] === 200) {
            Alert::toast('Data berhasil dihapus', 'success');
            return back();
        }
    }
}
