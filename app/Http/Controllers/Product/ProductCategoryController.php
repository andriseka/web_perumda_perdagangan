<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProductCategoryController extends Controller
{
    protected $category;

    public function __construct(ProductCategory $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        $data = $this->category->getData()['data'];
        $pagination = $this->category->getData()['pagination'];
        return view('product.category.index', compact('data', 'pagination'));
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
