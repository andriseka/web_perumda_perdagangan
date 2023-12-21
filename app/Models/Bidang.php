<?php

namespace App\Models;

use App\Traits\Pagination;
use Dflydev\DotAccessData\Data;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class Bidang extends Model
{
    use HasFactory, Pagination;

    protected $table = 'bidangs';
    protected $fillable = [
        'name', 'slug', 'content', 'link', 'image'
    ];

    public function getData()
    {
        $bidang = $this->select('name', 'slug', 'link', 'content', 'image')->orderBy('created_at', 'asc')->paginate(10);
        $remapp = [];
        foreach ($bidang as $key => $value) {
            $data = [
                'no' => $key + $bidang->firstitem(),
                'name' => $value->name,
                'slug' => $value->slug,
                'link' => $value->link,
                'image' => asset('uploads/bidang/'.$value->image),
                'content' => substr($value->content, 0, 90)
            ];
            array_push($remapp, $data);
        }

        $pagination = $this->pagination($bidang->total(), $bidang->perPage(), $bidang->currentPage(), $bidang->lastPage());

        $response = [
            'status' => 200,
            'data' => $remapp,
            'pagination' => $pagination
        ];
        return $response;
    }

    public function getDetail($slug)
    {
        $bidang = $this->where('slug', $slug)->first();
        if (! $bidang) {
            $response = [
                'status' => 404,
                'message' => 'success'
            ];
            return $response;
        }

        $response = [
            'status' => 200,
            'data' => $bidang
        ];
        return $response;
    }

    public function storeData(array $data)
    {
        $validation = Validator::make($data, [
            'name' => 'required|string|max:255|unique:bidangs,name,',
            'content' => 'nullable',
            'image' => 'nullable|image|mimes:png,jpg,jpeg'
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
            $image->move(public_path('uploads/bidang'), $newImage);
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

    public function updateData(array $data, $slug)
    {
        $bidang = $this->where('slug', $slug)->first();
        if (! $bidang) {
            $response = [
                'status' => 404,
                'message' => 'not found'
            ];
            return $response;
        }
        $validation = Validator::make($data, [
            'name' => 'required|string|max:255|unique:bidangs,name,'.$bidang->id,
            'content' => 'nullable',
            'image' => 'nullable|image|mimes:png,jpg,jpeg'
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
            $image->move(public_path('uploads/bidang'), $newImage);
            if ($bidang->image !== null) {
                File::delete(public_path('uploads/bidang/'.$bidang->image));
            }
        } else {
            $newImage = $bidang->image;
        }

        $data['image'] = $newImage;
        $data['slug'] = Str::slug($data['name']);

        $bidang->update($data);

        $response = [
            'status' => 200,
            'message' => 'success'
        ];
        return $response;
    }

    public function deleteData($slug)
    {
        $bidang = $this->where('slug', $slug)->first();
        if (! $bidang) {
            $response = [
                'status' => 404,
                'message' => 'not found'
            ];
            return $response;
        }

        if ($bidang->image !== null) {
            File::delete(public_path('uploads/bidang/'.$bidang->image));
        }

        $bidang->delete();

        $response = [
            'status' => 200,
            'message' => 'success'
        ];
        return $response;
    }
}
