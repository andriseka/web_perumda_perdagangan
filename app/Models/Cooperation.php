<?php

namespace App\Models;

use App\Traits\Pagination;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class Cooperation extends Model
{
    use HasFactory, Pagination;

    protected $table = 'cooperations';
    protected $fillable = [
        'name', 'slug', 'content', 'image'
    ];

    public function getData()
    {
        $cooperation = $this->select('name', 'slug', 'content', 'image')->orderBy('created_at', 'asc')->paginate(10);
        $remapp = [];
        foreach ($cooperation as $key => $value) {
            if ($value->image !== null) {
                $image = asset('uploads/kerjasama/'.$value->image);
            } else {
                $image = null;
            }
            $data = [
                'no' => $key + $cooperation->firstitem(),
                'name' => $value->name,
                'slug' => $value->slug,
                'short_desc' => substr($value->content,0,90),
                'image' => $image
            ];

            array_push($remapp, $data);
        }

        $pagination = $this->pagination($cooperation->total(), $cooperation->perPage(), $cooperation->currentPage(), $cooperation->lastPage());

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
            'name' => 'required|string|max:255|unique:cooperations,name,',
            'content' => 'nullable',
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
            $image->move(public_path('uploads/kerjasama'), $newImage);
        } else {
            $newImage = null;
        }

        $data['image'] = $newImage;
        $data['slug'] = Str::slug($data['name']);

        $this->create($data);

        $response = [
            'status' => 201,
            'message' => 'success'
        ];
        return $response;
    }

    public function getDetail($slug)
    {
        $cooperation = $this->where('slug', $slug)->first();
        if (! $cooperation) {
            $response = [
                'status' => 404,
                'message' => 'not found'
            ];
            return $response;
        }

        if ($cooperation->image !== null) {
            $cooperation->image = asset('uploads/kerjasama/'.$cooperation->image);
        } else {
            $cooperation->image = null;
        }

        $response = [
            'status' => 200,
            'data' => $cooperation
        ];
        return $response;
    }

    public function updateData(array $data, $slug)
    {
        $cooperation = $this->where('slug', $slug)->first();
        if (! $cooperation) {
            $response = [
                'status' => 404,
                'message' => 'not found'
            ];
            return $response;
        }

        $validation = Validator::make($data, [
            'name' => 'required|string|max:255|unique:cooperations,name,'.$cooperation->id,
            'content' => 'nullable',
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
            $image->move(public_path('uploads/kerjasama'), $newImage);
            if ($cooperation->image !== null) {
                File::delete(public_path('uploads/kerjasama/'.$cooperation->image));
            }
        } else {
            $newImage = $cooperation->image;
        }

        $data['image'] = $newImage;
        $data['slug'] = Str::slug($data['name']);

        $cooperation->update($data);

        $response = [
            'status' => 200,
            'message' => 'success'
        ];
        return $response;
    }

    public function deleteData($slug)
    {
        $cooperation = $this->where('slug', $slug)->first();
        if (! $cooperation) {
            $response = [
                'status' => 404,
                'message' => 'not found'
            ];
            return $response;
        }

        if ($cooperation->image !== null) {
            File::delete(public_path('uploads/kerjasama/'.$cooperation->image));
        }

        $cooperation->delete();

        $response = [
            'status' => 200,
            'message' => 'success'
        ];
        return $response;
    }
}
