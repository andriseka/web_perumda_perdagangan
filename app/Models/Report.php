<?php

namespace App\Models;

use App\Traits\Pagination;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class Report extends Model
{
    use HasFactory, Pagination;

    protected $table = 'reports';
    protected $fillable = [
        'year', 'desc', 'total_anggaran', 'file'
    ];

    public function getData()
    {
        $report = $this->select('id', 'year', 'desc', 'total_anggaran', 'file')->orderBy('year', 'asc')->paginate(6);
        $total = $this->selectRaw('SUM(total_anggaran) as total')->first();
        $remapp = [];
        foreach ($report as $key => $value) {
            $data = [
                'no' => $key + $report->firstitem(),
                'id' => $value->id,
                'year' => $value->year,
                'desc' => $value->desc,
                'total_anggaran' => $value->total_anggaran,
                'file' => $value->file
            ];

            array_push($remapp, $data);
        }

        $pagination = $this->pagination($report->total(), $report->perPage(), $report->currentPage(), $report->lastPage());

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
            'year' => 'required|integer|unique:reports,year',
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
            $file->move(public_path('uploads/report'), $newFile);
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
        $report = $this->where('id', $id)->first();
        if (! $report) {
            $response = [
                'status' => 404,
                'message' => 'Not found'
            ];
            return $response;
        }

        $validation = Validator::make($data, [
            'year' => 'required|unique:reports,year,'.$report->id,
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
            $file->move(public_path('uploads/report'), $newFile);
            if ($report->file !== null) {
                File::delete(public_path('uploads/report/'.$report->file));
            }
        } else {
            $newFile = $report->file;
        }

        $replaceRp = str_replace('Rp. ', '', $data['total_anggaran']);
        $data['total_anggaran'] = (int)str_replace('.', '', $replaceRp);

        $data['file'] = $newFile;

        $report->update($data);

        $response = [
            'status' => 200,
            'message' => 'success'
        ];
        return $response;
    }

    public function deleteData($year)
    {
        $report = $this->where('year', $year)->first();

        if ($report->file !== null) {
            File::delete(public_path('uploads/report/'.$report->file));
        }

        $report->delete();

        $response = [
            'status' => 200,
            'message' => 'success'
        ];
        return $response;
    }
}
