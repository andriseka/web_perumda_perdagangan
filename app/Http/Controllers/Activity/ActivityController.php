<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ActivityController extends Controller
{
    protected $activity;

    public function __construct(Activity $activity)
    {
        $this->activity = $activity;
    }

    public function index()
    {
        $data = $this->activity->getData();
        return view('activity.index', compact('data'));
    }

    public function store(Request $request)
    {
        $store = $this->activity->storeData($request->all());
        if ($store['status'] == 201) {
            Alert::toast('Data berhasil disimpan', 'success');
            return back();
        }
        if ($store['status'] == 400) {
            Alert::toast('Periksa kembali data Anda', 'error');
            return back()->withInput()->withErrors($store['message']);
        }
    }

    public function update(Request $request, $id)
    {
        $update = $this->activity->updateData($request->all(), $id);
        if ($update['status'] == 200) {
            Alert::toast('Data berhasil diupdate', 'success');
            return back();
        }
        if ($update['status'] == 400) {
            Alert::toast('Periksa kembali data Anda', 'error');
            return back();
        }
    }

    public function delete($id)
    {
        $delete = $this->activity->deleteData($id);
        if ($delete['status'] === 200) {
            Alert::toast('Data berhasil dihapus', 'success');
            return back();
        }
    }
}
