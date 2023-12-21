<?php

namespace App\Models;

use App\Traits\Pagination;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class Slider extends Model
{
    use HasFactory, Pagination;

    protected $table = 'sliders';
    protected $fillable = [
        'slider'
    ];

    public function getData()
    {
        $slider = $this->select('id', 'slider')->orderBy('created_at', 'desc')->paginate(5);
        $remapp = [];
        foreach ($slider as $value) {
            $explode = explode('.', $value->slider);
            $data = [
                'id' => $value->id,
                'slider' => asset('uploads/slider/'.$value->slider),
                'type' => $explode[1]
            ];
            array_push($remapp, $data);
        }

        $pagination = $this->pagination($slider->total(), $slider->perPage(), $slider->currentPage(), $slider->lastPage());

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
            'slider' => 'required|mimes:png,jpg,jpeg,mp4|max:2048'
        ]);
        if ($validation->fails()) {
            $response = [
                'status' => 400,
                'message' => $validation->errors()
            ];
            return $response;
        }

        $slider = $data['slider'];
        $newSlider = time().Str::random(10).'.'.$slider->getClientOriginalExtension();
        $slider->move(public_path('uploads/slider'), $newSlider);

        $data['slider'] = $newSlider;

        $this->create($data);

        $response = [
            'status' => 201,
            'message' => 'success'
        ];
        return $response;
    }

    public function deleteData($id)
    {
        $slider = $this->where('id', $id)->first();
        if (! $slider) {
            $response = [
                'status' => 404,
                'message' => 'not found'
            ];
            return $response;
        }

        File::delete(public_path('uploads/slider/'.$slider->slider));

        $slider->delete();

        $response = [
            'status' => 200,
            'message' => 'success'
        ];
        return $response;
    }
}
