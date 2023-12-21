<?php

namespace App\Models;

use App\Traits\Pagination;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class Ads extends Model
{
    use HasFactory, Pagination;

    protected $table = 'ads';
    protected $fillable = [
        'name', 'slug', 'type', 'link', 'desc', 'image'
    ];

    public function getByType($type)
    {
        $ads = $this->where('type', $type)->first();

        if ($ads->image !== null) {
            $image = asset('uploads/ads/'.$ads->image);
        } else {
            $image = null;
        }

        $data = [
            'name' => $ads->name,
            'desc' => $ads->desc,
            'type' => $ads->type,
            'link' => $ads->link,
            'image' => $image
        ];

        $response = [
            'status' => 200,
            'data' => $data
        ];
        return $response;
    }

    public function getData()
    {
        $ads = $this->select('name', 'slug', 'type', 'desc', 'image', 'link')->orderBy('created_at', 'desc')->paginate(10);

        $remapp = [];
        foreach ($ads as $key => $value) {
            if ($value->image !== null) {
                $image = asset('uploads/ads/'.$value->image);
            } else {
                $image = null;
            }
            $data = [
                'no' => $key + $ads->firstitem(),
                'name' => $value->name,
                'slug' => $value->slug,
                'desc' => $value->desc,
                'type' => $value->type,
                'link' => $value->link,
                'image' => $image
            ];
            array_push($remapp, $data);
        }

        $pagination = $this->pagination($ads->total(), $ads->perPage(), $ads->currentPage(), $ads->lastPage());

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
            'name' => 'required|string|max:255|unique:ads,name,',
            'desc' => 'nullable',
            'type' => 'required',
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
            $image->move(public_path('uploads/ads'), $newImage);
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
        $ads = $this->where('slug', $slug)->first();
        if (! $ads) {
            $response = [
                'status' => 404,
                'message' => 'not found'
            ];
            return $response;
        }


        $validation = Validator::make($data, [
            'name' => 'required|string|max:255|unique:ads,name,'.$ads->id,
            'desc' => 'nullable',
            'type' => 'required',
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
            $image->move(public_path('uploads/ads'), $newImage);
            if ($ads->image !== null) {
                File::delete(public_path('uploads/ads/'.$ads->image));
            }
        } else {
            $newImage = $ads->image;
        }

        $data['image'] = $newImage;
        $data['slug'] = Str::slug($data['name']);

        $ads->update($data);

        $response = [
            'status' => 200,
            'message' => 'success'
        ];
        return $response;
    }

    public function deleteData($slug)
    {
        $ads = $this->where('slug', $slug)->first();
        if (! $ads) {
            $response = [
                'status' => 404,
                'message' => 'not found'
            ];
            return $response;
        }

        if ($ads->image !== null) {
            File::delete(public_path('uploads/ads/'.$ads->image));
        }

        $ads->delete();

        $response = [
            'status' => 200,
            'message' => 'success'
        ];
        return $response;
    }
}
