<?php

namespace App\Models;

use App\Traits\Pagination;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class Partner extends Model
{
    use HasFactory, Pagination;

    protected $table = 'partners';
    protected $fillable = [
        'name', 'slug', 'link', 'logo'
    ];

    public function getData()
    {
        $partner = $this->select('name', 'slug', 'link', 'logo')->orderBy('created_at', 'desc')->paginate(8);
        $remapp = [];
        foreach ($partner as $key => $value) {
            $data = [
                'no' => $key + $partner->firstitem(),
                'name' => $value->name,
                'slug' => $value->slug,
                'link' => $value->link,
                'logo' => asset('uploads/partner/'.$value->logo)
            ];
            array_push($remapp, $data);
        }

        $pagination = $this->pagination($partner->total(), $partner->perPage(), $partner->currentPage(), $partner->lastPage());

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
            'name' => 'required|string|max:255|unique:partners,name,',
            'link' => 'nullable',
            'logo' => 'required|image|mimes:png,jpg,jpeg'
        ]);
        if ($validation->fails()) {
            $response = [
                'status' => 400,
                'message' => $validation->errors()
            ];
            return $response;
        }

        $logo = $data['logo'];
        $newLogo = time().Str::random(10).'.'.$logo->getClientOriginalExtension();
        $logo->move(public_path('uploads/partner'), $newLogo);

        $data['slug'] = Str::slug($data['name']);
        $data['logo'] = $newLogo;

        $this->create($data);

        $response = [
            'status' => 201,
            'message' => 'success'
        ];
        return $response;
    }

    public function updateData(array $data, $slug)
    {
        $partner = $this->where('slug', $slug)->first();

        $validation = Validator::make($data, [
            'name' => 'required|string|max:255|unique:partners,name,'.$partner->id,
            'link' => 'nullable',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg'
        ]);
        if ($validation->fails()) {
            $response = [
                'status' => 400,
                'message' => $validation->errors()
            ];
            return $response;
        }

        if (isset($data['logo'])) {
            $logo = $data['logo'];
            $newLogo = time().Str::random(10).'.'.$logo->getClientOriginalExtension();
            $logo->move(public_path('uploads/partner'), $newLogo);
            if ($partner->logo !== null) {
                File::delete(public_path('uploads/partner/'.$partner->logo));
            }
        } else {
            $newLogo = $partner->logo;
        }

        $data['logo'] = $newLogo;
        $data['slug'] = Str::slug($data['name']);

        $partner->update($data);

        $response = [
            'status' => 200,
            'message' => 'success'
        ];
        return $response;
    }

    public function deleteData($slug)
    {
        $partner = $this->where('slug', $slug)->first();
        if (! $partner) {
            $response = [
                'status' => 404,
                'message' => 'not found'
            ];
            return $response;
        }

        if ($partner->logo !== null) {
            File::delete(public_path('uploads/partner/'.$partner->logo));
        }

        $partner->delete();

        $response = [
            'status' => 200,
            'message' => 'success'
        ];
        return $response;
    }
}
