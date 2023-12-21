<?php

namespace App\Models;

use App\Traits\Pagination;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductCategory extends Model
{
    use HasFactory, Pagination;

    protected $table = 'product_categories';
    protected $fillable = [
        'name', 'slug', 'count', 'desc'
    ];

    public function getAll()
    {
        $category = $this->select('id', 'name' ,'slug', 'count')->orderBy('created_at', 'desc')->get();
        $remapp = [];
        foreach ($category as $value) {
            $data = [
                'id' => $value->id,
                'name' => $value->name,
                'slug' => $value->slug,
                'count' => $value->count
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
        $category = $this->select('name', 'slug', 'desc', 'count')->orderBy('created_at', 'desc')->paginate(6);
        $remapp = [];
        foreach ($category as $key => $value) {
            $data = [
                'no' => $key + $category->firstitem(),
                'name' => $value->name,
                'slug' => $value->slug,
                'desc' => $value->desc,
                'count' => $value->count
            ];
            array_push($remapp, $data);
        }

        $pagination = $this->pagination($category->total(), $category->perPage(), $category->currentPage(), $category->lastPage());

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
            'name' => 'required|string|max:255|unique:product_categories,name,',
        ]);
        if ($validation->fails()) {
            $response = [
                'status' => 400,
                'message' => $validation->errors()
            ];
            return $response;
        }

        $data['slug'] = Str::slug($data['name']);

        $this->create($data);

        $response = [
            'status' => 201,
            'message' => 'success'
        ];
        return $response;
    }

    public function updateData(array $data, $slug)
    {
        $category = $this->where('slug', $slug)->first();

        $validation = Validator::make($data, [
            'name' => 'required|string|max:255|unique:post_categories,name,'.$category->id,
            'desc' => 'nullable|string'
        ]);
        if ($validation->fails()) {
            $response = [
                'status' => 400,
                'message' => $validation->errors()
            ];
            return $response;
        }

        $data['slug'] = Str::slug($data['name']);

        $category->update($data);

        $response = [
            'status' => 200,
            'message' => 'success'
        ];
        return $response;
    }

    public function deleteData($slug)
    {
        $category = $this->where('slug', $slug)->first();
        $product = DB::table('products')->where('product_category_id', $category->id)->count();
        DB::table('products')->where('product_category_id', $category->id)->update([
            'product_category_id' => 0
        ]);

        $uncategorized = $this->where('id', 0)->first();
        $uncategorized->update(['count' => $uncategorized->count + $product]);

        $category->delete();

        $response = [
            'status' => 200,
            'message' => 'success'
        ];
        return $response;
    }
}
