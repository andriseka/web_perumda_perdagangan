<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class Struktur extends Model
{
    use HasFactory;

    protected $table = 'strukturs';
    protected $fillable = [
        'name', 'jabatan', 'motto', 'photo'
    ];

    public function getData()
    {
        $struktur = $this->select('id', 'name', 'jabatan', 'motto', 'photo')->get();
        $remapp = [];
        $no = 1;
        foreach ($struktur as $value) {
            if ($value->photo !== null) {
                $photo = asset('uploads/struktur/'.$value->photo);
            } else {
                $photo = null;
            }
            $data = [
                'no' => $no++,
                'id' => $value->id,
                'name' => $value->name,
                'jabatan' => $value->jabatan,
                'motto' => $value->motto,
                'photo' => $photo
            ];

            array_push($remapp, $data);
        }

        $response = [
            'status' => 200,
            'data' => $remapp
        ];
        return $response;
    }

    public function storeData(array $data)
    {
        $validation = Validator::make($data, [
            'name' => 'required|string|unique:strukturs,name,',
            'jabatan' => 'required|max:255',
            'motto' => 'nullable',
            'photo' => 'nullable|image|mimes:png,jpg,jpeg'
        ]);
        if ($validation->fails()) {
            $response = [
                'status' => 400,
                'message' => $validation->errors()
            ];
            return $response;
        }

        if (isset($data['photo'])) {
            $photo = $data['photo'];
            $newPhoto = time().Str::random(10).'.'.$photo->getClientOriginalExtension();
            $photo->move(public_path('uploads/struktur'), $newPhoto);
        } else {
            $newPhoto = null;
        }

        $data['photo'] = $newPhoto;

        $this->create($data);

        $response = [
            'status' => 201,
            'message' => 'success'
        ];
        return $response;
    }

    public function updateData(array $data, $id)
    {
        $struktur = $this->where('id', $id)->first();
        if (! $struktur) {
            $response = [
                'status' => 404,
                'message' => 'not found'
            ];
            return $response;
        }
        $validation = Validator::make($data, [
            'name' => 'required|string|unique:strukturs,name,'.$struktur->id,
            'jabatan' => 'required|max:255',
            'motto' => 'nullable',
            'photo' => 'nullable|image|mimes:png,jpg,jpeg'
        ]);
        if ($validation->fails()) {
            $response = [
                'status' => 400,
                'message' => $validation->errors()
            ];
            return $response;
        }

        if (isset($data['photo'])) {
            $photo = $data['photo'];
            $newPhoto = time().Str::random(10).'.'.$photo->getClientOriginalExtension();
            $photo->move(public_path('uploads/struktur'), $newPhoto);
            if ($struktur->photo !== null) {
                File::delete(public_path('uploads/struktur/'.$struktur->photo));
            }
        } else {
            $newPhoto = $struktur->photo;
        }

        $data['photo'] = $newPhoto;

        $struktur->update($data);

        $response = [
            'status' => 200,
            'message' => 'success'
        ];
        return $response;
    }

    public function deleteData($id)
    {
        $struktur = $this->where('id', $id)->first();
        if (! $struktur) {
            $response = [
                'status' => 404,
                'message' => 'not found'
            ];
            return $response;
        }

        if ($struktur->photo !== null) {
            File::delete(public_path('uploads/struktur/'.$struktur->photo));
        }

        $struktur->delete();

        $response = [
            'status' => 200,
            'message' => 'success'
        ];
        return $response;
    }
}
