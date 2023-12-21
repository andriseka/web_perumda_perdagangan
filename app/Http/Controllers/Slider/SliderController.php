<?php

namespace App\Http\Controllers\Slider;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SliderController extends Controller
{
    protected $slider;

    public function __construct(Slider $slider)
    {
        $this->slider = $slider;
    }

    public function index()
    {
        $data = $this->slider->getData();
        return view('slider.index', compact('data'));
    }

    public function store(Request $request)
    {
        try {
            $store = $this->slider->storeData($request->all());

            if ($store['status'] === 201) {
                Alert::toast('Data berhasil disimpan', 'success');
                return back();
            }

            if ($store['status'] === 400) {
                Alert::toast('Periksa kembali data Anda', 'error');
                return back()->withErrors($store['message']);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function delete($id)
    {
        $delete = $this->slider->deleteData($id);
        if ($delete['status'] === 200) {
            Alert::toast('Data berhasil dihapus', 'success');
            return back();
        }
    }
}
