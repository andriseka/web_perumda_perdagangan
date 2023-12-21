<?php

namespace App\Models;

use App\Traits\Pagination;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory, Pagination;

    protected $table = 'products';
    protected $fillable = [
        'name', 'slug', 'product_category_id', 'desc', 'image'
    ];

    public function getByLimit($limit)
    {
        $product = $this->join('product_categories', 'products.product_category_id', '=', 'product_categories.id')
                ->select('products.name', 'product_categories.name as cateory', 'products.slug', 'products.image', 'products.desc')
                ->orderBy('products.created_at', 'desc')
                ->take($limit)
                ->get();

        $remapp = [];
        foreach ($product as $value) {
            if ($value->image !== null) {
                $image = asset('uploads/product/'.$value->image);
            } else {
                $image = null;
            }

            $data = [
                'name' => $value->name,
                'slug' => $value->slug,
                'category' => $value->category,
                'image' => $image,
                'short_desc' => substr($value->desc,0, 50)
            ];
            array_push($remapp, $data);
        }

        $response = [
            'status' => 200,
            'data' => $remapp
        ];
        return $response;
    }

    public function getData()
    {
        $product = $this->join('product_categories', 'products.product_category_id', '=', 'product_categories.id')
                    ->select('products.name', 'products.slug', 'product_categories.name as category', 'products.image', 'products.desc')
                    ->orderBy('products.created_at', 'desc')
                    ->paginate(12);

        $remapp = [];
        foreach ($product as $key => $value) {
            if ($value->image !== null) {
                $image = asset('uploads/product/'.$value->image);
            } else {
                $image = null;
            }
            $data = [
                'no' => $key + $product->firstitem(),
                'name' => $value->name,
                'slug' => $value->slug,
                'image' => $image,
                'short_desc' => substr($value->desc,0,90),
                'category' => $value->category
            ];
            array_push($remapp, $data);
        }

        $pagination = $this->pagination($product->total(), $product->perPage(), $product->currentPage(), $product->lastPage());

        $response = [
            'status' => 200,
            'data' => $remapp,
            'pagination' => $pagination
        ];
        return $response;
    }

    public function storeData(array $data)
    {
        $validation = Validator::make($data, [
            'name' => 'required|string|max:255|unique:products,name,',
            'product_category_id' => 'required|exists:product_categories,id',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ]);
        if ($validation->fails()) {
            $response = [
                'status' => 400,
                'message' => $validation->errors()
            ];
            return $response;
        }

        if (isset($data['image'])) {
            $image = $data['image'];
            $newImage = time().Str::random(10).'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/product'), $newImage);
        } else {
            $newImage = null;
        }

        $data['image'] = $newImage;
        $data['slug'] = Str::slug($data['name']);

        $this->create($data);

        $category = DB::table('product_categories')->where('id', $data['product_category_id'])->first();

        DB::table('product_categories')->where('id', $data['product_category_id'])->update([
            'count' => $category->count + 1
        ]);

        $response = [
            'status' => 201,
            'message' => 'success'
        ];
        return $response;
    }

    public function getByCategory($slug)
    {
        $category = DB::table('product_categories')->where('slug', $slug)->first();
        $product = $this->where('product_category_id', $category->id)->orderBy('created_at', 'desc')->paginate(10);

        $remapp = [];

        foreach ($product as $key => $value) {
            if ($value->image !== null) {
                $image = asset('uploads/product/'.$value->image);
            } else {
                $image = null;
            }

            $data = [
                'no' => $key + $product->firstitem(),
                'name' => $value->name,
                'slug' => $value->slug,
                'image' => $image,
                'short_desc' => substr($value->desc,0,90),
                'category' => $category->name
            ];

            array_push($remapp, $data);
        }

        $pagination = $this->pagination($product->total(), $product->perPage(), $product->currentPage(), $product->lastPage());

        $response = [
            'status' => 200,
            'data' => $remapp,
            'category' => $category->name,
            'pagination' => $pagination
        ];
        return $response;
    }

    public function searchDataProduct(array $data)
    {
        $slug = Str::slug($data['name']);
        $product = $this->where('products.slug', 'like', $slug.'%')
                    ->join('product_categories', 'products.product_category_id', '=', 'product_categories.id')
                    ->select('products.name', 'products.slug', 'product_categories.name as category', 'products.image', 'products.desc')
                    ->orderBy('products.created_at', 'desc')
                    ->paginate(12);

        $remapp = [];
        foreach ($product as $key => $value) {
            if ($value->image !== null) {
                $image = asset('uploads/product/'.$value->image);
            } else {
                $image = null;
            }
            $data = [
                'no' => $key + $product->firstitem(),
                'name' => $value->name,
                'slug' => $value->slug,
                'image' => $image,
                'short_desc' => substr($value->desc,0,90),
                'category' => $value->category
            ];
            array_push($remapp, $data);
        }

        $pagination = $this->pagination($product->total(), $product->perPage(), $product->currentPage(), $product->lastPage());

        $response = [
            'status' => 200,
            'data' => $remapp,
            'name' => $data['name'],
            'pagination' => $pagination
        ];
        return $response;
    }

    public function getDetail($slug)
    {
        $product = $this->where('slug', $slug)->first();
        $category = DB::table('product_categories')->where('id', $product->product_category_id)->first();
        if (! $product) {
            $response = [
                'status' => 404,
                'message' => 'not found'
            ];
            return $response;
        }

        if ($product->image !== null) {
            $product->image  = asset('uploads/product/'.$product->image);
        } else {
            $product->image = null;
        }

        $product['category'] = $category->name;

        $response = [
            'status' => 200,
            'data' => $product
        ];
        return $response;
    }

    public function updateData(array $data, $slug)
    {
        $product = $this->where('slug', $slug)->first();
        $validation = Validator::make($data, [
            'name' => 'required|string|max:255|unique:products,name,'.$product->id,
            'product_category_id' => 'required|exists:product_categories,id',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ]);
        if ($validation->fails()) {
            $response = [
                'status' => 400,
                'message' => $validation->errors()
            ];
            return $response;
        }

        if (isset($data['image'])) {
            $image = $data['image'];
            $newImage = time().Str::random(10).'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/product'), $newImage);
            if ($product->image !== null) {
                File::delete(public_path('uploads/product/'.$product->image));
            }
        } else {
            $newImage = $product->image;
        }

        $data['image'] = $newImage;
        $data['slug'] = Str::slug($data['name']);

        if ($product->product_category_id !== $data['product_category_id']) {
            $category = DB::table('product_categories')->where('id', $data['product_category_id'])->first();
            DB::table('product_categories')->where('id', $data['product_category_id'])->update([
                'count' => $category->count + 1
            ]);

            $category1 = DB::table('product_categories')->where('id', $product->product_category_id)->first();
            DB::table('product_categories')->where('id', $product->product_category_id)->update([
                'count' => $category1->count - 1
            ]);
        }

        $product->update($data);

        $response = [
            'status' => 200,
            'message' => 'success'
        ];
        return $response;
    }

    public function deleteData($slug)
    {
        $product = $this->where('slug', $slug)->first();
        $category1 = DB::table('product_categories')->where('id', $product->product_category_id)->first();
        DB::table('product_categories')->where('id', $product->product_category_id)->update([
            'count' => $category1->count - 1
        ]);

        if ($product->image !== null) {
            File::delete(public_path('uploads/product/'.$product->image));
        }

        $product->delete();

        $response = [
            'status' => 200,
            'message' => 'success'
        ];
        return $response;
    }
}
