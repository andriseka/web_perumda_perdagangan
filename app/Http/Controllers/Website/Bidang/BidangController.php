<?php

namespace App\Http\Controllers\Website\Bidang;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use Illuminate\Http\Request;

class BidangController extends Controller
{
    protected $bidang;

    public function __construct(Bidang $bidang)
    {
        $this->bidang = $bidang;
    }

    public function index()
    {
        $bidang = $this->bidang->getData()['data'];
        return view('website.bidang.bidang', compact('bidang'));
    }

    public function detail($slug)
    {
        $bidang = $this->bidang->getDetail($slug)['data'];
        return view('website.bidang.bidang_detail', compact('bidang'));
    }
}
