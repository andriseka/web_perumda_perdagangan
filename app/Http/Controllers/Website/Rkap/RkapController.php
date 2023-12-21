<?php

namespace App\Http\Controllers\Website\Rkap;

use App\Http\Controllers\Controller;
use App\Models\Rkap;
use Illuminate\Http\Request;

class RkapController extends Controller
{
    protected $rkap;

    public function __construct(Rkap $rkap)
    {
        $this->rkap = $rkap;
    }

    public function index()
    {
        $data = $this->rkap->getData();
        return view('website.rkap.rkap', compact('data'));
    }
}
