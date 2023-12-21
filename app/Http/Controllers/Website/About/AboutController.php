<?php

namespace App\Http\Controllers\Website\About;

use App\Http\Controllers\Controller;
use App\Models\Struktur;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    protected $struktur;

    public function __construct(Struktur $struktur)
    {
        $this->struktur = $struktur;
    }

    public function index()
    {
        $struktur = $this->struktur->getData()['data'];
        return view('website.about.about', compact('struktur'));
    }
}
