<?php

namespace App\Http\Controllers\Website\Home;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Ads;
use App\Models\Cooperation;
use App\Models\Partner;
use App\Models\Post;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $slider;
    protected $post;
    protected $product;
    protected $category;
    protected $ads;

    public function __construct(Slider $slider, Post $post, Product $product, ProductCategory $category, Ads $ads)
    {
        $this->slider = $slider;
        $this->post = $post;
        $this->product = $product;
        $this->category = $category;
        $this->ads = $ads;
    }

    public function index()
    {
        $slider = $this->slider->getData()['data'];
        $post = $this->post->getByLimit(3)['data'];
        $product = $this->product->getByLimit(6)['data'];
        $category = $this->category->getAll()['data'];
        $homeAds = $this->ads->getByType('home')['data'];
        return view('website.home', compact('slider', 'post', 'product', 'category', 'homeAds'));
    }
}
