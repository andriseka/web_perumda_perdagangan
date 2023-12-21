<?php

namespace App\Http\Controllers\Website\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $product;
    protected $category;

    public function __construct(Product $product, ProductCategory $category)
    {
        $this->product = $product;
        $this->category = $category;
    }

    public function index()
    {
        $data = $this->product->getData();
        $category = $this->category->getAll()['data'];
        return view('website.product.product', compact('data', 'category'));
    }

    public function detail($slug)
    {
        $product = $this->product->getDetail($slug)['data'];
        $new_products = $this->product->getByLimit(4)['data'];
        return view('website.product.product_detail', compact('product', 'new_products'));
    }

    public function product_category($slug)
    {
        try {
            $data = $this->product->getByCategory($slug);
            return view('website.product.product_category', compact('data'));
        } catch (\Throwable $th) {
            return abort(404);
        }
    }

    public function search(Request $request)
    {
        try {
            $data = $this->product->searchDataProduct($request->all());
            return view('website.product.product_seacrh', compact('data'));
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
