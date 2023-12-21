<?php

namespace App\Models;

use App\Traits\Pagination;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class Rkap extends Model
{
    use HasFactory, Pagination;

    protected $table = 'rkaps';
    protected $fillable = [
        'year', 'desc', 'total_anggaran', 'file'
    ];

    public function getData()
    {
        $rkap = $this->select('id', 'year', 'desc', 'total_anggaran', 'file')->orderBy('year', 'asc')->paginate(6);
        $total = $this->selectRaw('SUM(total_anggaran) as total')->first();
        $remapp = [];
        foreach ($rkap as $key => $value) {
            $data = [
                'no' => $key + $rkap->firstitem(),
                'id' => $value->id,
                'year' => $value->year,
                'desc' => $value->desc,
                'total_anggaran' => $value->total_anggaran,
                'file' => $value->file
            ];

            array_push($remapp, $data);
        }

        $pagination = $this->pagination($rkap->total(), $rkap->perPage(), $rkap->currentPage(), $rkap->lastPage());

        $response = [
            'status' => 200,
            'data' => $remapp,
            'total' => $total->total,
            'pagination' => $pagination
        ];
        return $response;
    }

    public function storeData(array $data)
    {
        $validation = Validator::make($data, [
            'year' => 'required|integer|unique:rkaps,year',
            'desc' => 'nullable',
            'file' => 'nullable|mimes:xlsx',
            'total_anggaran' => 'required'
        ]);
        if ($validation->fails()) {
            $response = [
                'status' => 400,
                'message' => $validation->errors()
            ];
            return $response;
        }

        if (isset($data['file'])) {
            $file = $data['file'];
            $newFile = time().Str::random(10).'.'.$file->getClientoriginalExtension();
            $file->move(public_path('uploads/rkap'), $newFile);
        } else {
            $newFile = null;
        }

        $replaceRp = str_replace('Rp. ', '', $data['total_anggaran']);
        $data['total_anggaran'] = (int)str_replace('.', '', $replaceRp);

        $data['file'] = $newFile;

        $this->create($data);

        $response = [
            'status' => 201,
            'message' => 'success'
        ];
        return $response;
    }

    public function updateData(array $data, $id)
    {
        $rkap = $this->where('id', $id)->first();
        if (! $rkap) {
            $response = [
                'status' => 404,
                'message' => 'Not found'
            ];
            return $response;
        }

        $validation = Validator::make($data, [
            'year' => 'required|unique:rkaps,year,'.$rkap->id,
            'desc' => 'nullable',
            'file' => 'nullable|mimes:xlsx',
            'total_anggaran' => 'required'
        ]);

        if ($validation->fails()) {
            $response = [
                'status' => 400,
                'message' => $validation->errors()
            ];
            return $response;
        }

        if (isset($data['file'])) {
            $file = $data['file'];
            $newFile = time().Str::random(10).'.'.$file->getClientoriginalExtension();
            $file->move(public_path('uploads/rkap'), $newFile);
            if ($rkap->file !== null) {
                File::delete(public_path('uploads/rkap/'.$rkap->file));
            }
        } else {
            $newFile = $rkap->file;
        }

        $replaceRp = str_replace('Rp. ', '', $data['total_anggaran']);
        $data['total_anggaran'] = (int)str_replace('.', '', $replaceRp);

        $data['file'] = $newFile;

        $rkap->update($data);

        $response = [
            'status' => 200,
            'message' => 'success'
        ];
        return $response;
    }

    public function deleteData($year)
    {
        $rkap = $this->where('year', $year)->first();

        if ($rkap->file !== null) {
            File::delete(public_path('uploads/rkap/'.$rkap->file));
        }

        $rkap->delete();

        $response = [
            'status' => 200,
            'message' => 'success'
        ];
        return $response;
    }
}
