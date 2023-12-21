<?php

namespace App\Http\Controllers\Award;

use App\Http\Controllers\Controller;
use App\Models\Award;
use App\Models\AwardCategory;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AwardController extends Controller
{
    protected $category;
    protected $award;

    public function __construct(AwardCategory $category, Award $award)
    {
        $this->category = $category;
        $this->award = $award;
    }

    public function index()
    {
        $data = $this->award->getData();
        return view('award.index', compact('data'));
    }

    public function create()
    {
        $categories = $this->category->getAll()['data'];
        return view('award.create', compact('categories'));
    }

    public function edit($slug)
    {
        $award = $this->award->getDetail($slug)['data'];
        $categories = $this->category->getAll()['data'];
        return view('award.edit', compact('award', 'categories'));
    }

    public function store(Request $request)
    {
        try {
            $store = $this->award->storeData($request->all());
            if ($store['status'] === 400) {
                Alert::toast('Periksa kembali dat Anda', 'error');
                return back()->withInput()->withErrors($store['message']);
            }

            if ($store['status'] === 201) {
                Alert::toast('Data berhasil disimpan', 'success');
                return redirect('/admin/award');
            }
        } catch (\Throwable $th) {

        }
    }

    public function update(Request $request, $slug)
    {
        $update = $this->award->updateData($request->all(), $slug);
        if ($update['status'] === 400) {
            Alert::toast('Periksa kembali data Anda', 'error');
            return back()->withErrors($update['message']);
        }

        if ($update['status'] === 200) {
            Alert::toast('Data berhasil diupdate', 'success');
            return redirect('/admin/award');
        }
    }

    public function delete($slug)
    {
        $delete = $this->award->deleteData($slug);
        if ($delete['status'] === 200) {
            Alert::toast('Data berhasil dihapus', 'success');
            return back();
        }
    }
}
