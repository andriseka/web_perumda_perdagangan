<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    protected $category;
    protected $product;

    public function __construct(ProductCategory $category, Product $product)
    {
        $this->category = $category;
        $this->product = $product;
    }

    public function index()
    {
        $data = $this->product->getData();
        return view('product.index', compact('data'));
    }

    public function create()
    {
        $categories = $this->category->getAll()['data'];
        return view('product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        try {
            $store = $this->product->storeData($request->all());
            if ($store['status'] === 400) {
                Alert::toast('Periksa kembali dat Anda', 'error');
                return back()->withInput()->withErrors($store['message']);
            }

            if ($store['status'] === 201) {
                Alert::toast('Data berhasil disimpan', 'success');
                return redirect('/admin/product');
            }
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function edit($slug)
    {
        $product = $this->product->getDetail($slug)['data'];
        $categories = $this->category->getAll()['data'];
        return view('product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $slug)
    {
        $update = $this->product->updateData($request->all(), $slug);
        if ($update['status'] === 400) {
            Alert::toast('Periksa kembali data Anda', 'error');
            return back()->withErrors($update['message']);
        }

        if ($update['status'] === 200) {
            Alert::toast('Data berhasil diupdate', 'success');
            return redirect('/admin/product');
        }
    }

    public function delete($slug)
    {
        $delete = $this->product->deleteData($slug);
        if ($delete['status'] === 200) {
            Alert::toast('Data berhasil dihapus', 'success');
            return back();
        }
    }
}
