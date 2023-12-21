<?php

namespace App\Http\Controllers\Award;

use App\Http\Controllers\Controller;
use App\Models\AwardCategory;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AwardCategoryController extends Controller
{
    protected $category;

    public function __construct(AwardCategory $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        $data = $this->category->getData();
        return view('award.category.index', compact('data'));
    }

    public function store(Request $request)
    {
        try {
            $store = $this->category->storeData($request->all());
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
            $update = $this->category->updateData($request->all(), $slug);
            if ($update['status'] === 400) {
                Alert::toast('Periksa kembali data Anda', 'error');
                return back();
            }

            if ($update['status'] === 200) {
                Alert::toast('Data berhasil diupdate', 'success');
                return back();
            }
        } catch (\Throwable $th) {

        }
    }

    public function delete($slug)
    {
        try {
            $delete = $this->category->deleteData($slug);
            if ($delete['status'] === 200) {
                Alert::toast('Data berhasil dihapus', 'success');
                return back();
            }
        } catch (\Throwable $th) {

        }
    }
}
