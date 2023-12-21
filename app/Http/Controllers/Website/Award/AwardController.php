<?php

namespace App\Http\Controllers\Website\Award;

use App\Http\Controllers\Controller;
use App\Models\Award;
use App\Models\AwardCategory;
use Illuminate\Http\Request;

class AwardController extends Controller
{
    protected $award;
    protected $category;

    public function __construct(Award $award, AwardCategory $category)
    {
        $this->award = $award;
        $this->category = $category;
    }

    public function index()
    {
        $data = $this->award->getData();
        $category = $this->category->getAll()['data'];
        return view('website.award.award', compact('data', 'category'));
    }

    public function detail($slug)
    {
        $award = $this->award->getDetail($slug)['data'];
        return view('website.award.award_detail', compact('award'));
    }

    public function get_by_category($category_slug)
    {
        $category = $this->category->getAll()['data'];
        $data= $this->award->getByCategory($category_slug);
        return view('website.award.award_category', compact('category', 'data'));
    }
}
