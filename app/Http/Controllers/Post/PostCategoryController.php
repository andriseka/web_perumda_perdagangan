<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PostCategoryController extends Controller
{
    protected $category;

    public function __construct(PostCategory $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        $getData = $this->category->getData();

        $data = $getData['data'];
        $pagination = $getData['pagination'];

        return view('post.category.index', compact('data', 'pagination'));
    }

    public function store(Request $request)
    {
        try {
            $store = $this->category->storeData($request->all());
            if ($store['status'] === 400) {
                Alert::toast('Ada beberapa data yang salah', 'error');
                return back()->withInput()->withErrors($store['message']);
            }
            if ($store['status'] === 201) {
                Alert::toast('Data berhasil disimpan', 'success');
                return back();
            }
        } catch (\Throwable $th) {
            Alert::toast('Something is wrong', 'error');
            return back();
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
