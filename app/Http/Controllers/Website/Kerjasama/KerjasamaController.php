<?php

namespace App\Http\Controllers\Website\Kerjasama;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KerjasamaController extends Controller
{
    public function index()
    {
        return view('website.kerjasama.index');
    }
}
