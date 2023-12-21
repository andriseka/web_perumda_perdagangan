<?php

namespace App\Http\Controllers\Website\Cooperation;

use App\Http\Controllers\Controller;
use App\Models\Cooperation;
use Illuminate\Http\Request;

class CooperationController extends Controller
{
    protected $cooperation;

    public function __construct(Cooperation $cooperation)
    {
        $this->cooperation = $cooperation;
    }

    public function index($slug)
    {
        $cooperation = $this->cooperation->getDetail($slug)['data'];
        return view('website.cooperation.cooperation', compact('cooperation'));
    }
}
