<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PostController extends Controller
{
    protected $category;
    protected $post;

    public function __construct(PostCategory $category, Post $post)
    {
        $this->category = $category;
        $this->post = $post;
    }

    public function index()
    {
        $data = $this->post->getData();
        return view('post.index', compact('data'));
    }

    public function create()
    {
        $categories = $this->category->getAll()['data'];
        return view('post.create', compact('categories'));
    }

    public function store(Request $request)
    {
        try {
            $store = $this->post->storeData($request->all());
            if ($store['status'] === 400) {
                Alert::toast('Periksa kembali dat Anda', 'error');
                return back()->withInput()->withErrors($store['message']);
            }

            if ($store['status'] === 201) {
                Alert::toast('Data berhasil disimpan', 'success');
                return redirect('/admin/post');
            }
        } catch (\Throwable $th) {

        }
    }

    public function edit($slug)
    {
        $post = $this->post->getDetail($slug)['data'];
        $categories = $this->category->getAll()['data'];
        return view('post.edit', compact('post', 'categories'));
    }

    public function update(Request $request, $slug)
    {
        $update = $this->post->updateData($request->all(), $slug);
        if ($update['status'] === 400) {
            Alert::toast('Periksa kembali data Anda', 'error');
            return back()->withErrors($update['message']);
        }

        if ($update['status'] === 200) {
            Alert::toast('Data berhasil diupdate', 'success');
            return redirect('/admin/post');
        }
    }

    public function delete($slug)
    {
        $delete = $this->post->deleteData($slug);
        if ($delete['status'] === 200) {
            Alert::toast('Data berhasil dihapus', 'success');
            return back();
        }
    }
}
