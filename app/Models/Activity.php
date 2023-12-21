<?php

namespace App\Models;

use App\Traits\Pagination;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Activity extends Model
{
    use HasFactory, Pagination;

    protected $table = 'activities';
    protected $fillable = [
        'date', 'name', 'desc'
    ];

    public function getActivity()
    {
        $activity = $this->select('id', 'name', 'date', 'desc')->get();
        $remapp = [];
        foreach ($activity as $value) {
            $data = [
                'id' => (int)$value->id,
                'name' => $value->name,
                'desc' => $value->desc,
                'date' => $value->date
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
        $activity = $this->select('id', 'name', 'date', 'desc')->orderBy('created_at', 'desc')->paginate(10);
        $remapp = [];
        foreach ($activity as $key => $value) {
            $data = [
                'no' => $key + $activity->firstitem(),
                'id' => $value->id,
                'name' => $value->name,
                'date' => $value->date,
                'desc' => $value->desc
            ];
            array_push($remapp, $data);
        }

        $pagination = $this->pagination($activity->total(), $activity->perPage(), $activity->currentPage(), $activity->lastPage());

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
            'date' => 'required|date',
            'name' => 'required|string|max:255',
            'desc' => 'nullable'
        ]);
        if ($validation->fails()) {
            $response = [
                'status' => 400,
                'message' => $validation->errors()
            ];
            return $response;
        }

        $this->create($data);

        $response = [
            'status' => 201,
            'message' => 'success'
        ];
        return $response;
    }

    public function updateData(array $data, $id)
    {
        $activity = $this->where('id', $id)->first();
        if (! $activity) {
            $response = [
                'status' => 404,
                'message' => 'not found'
            ];
            return $response;
        }

        $validation = Validator::make($data, [
            'date' => 'required|date',
            'name' => 'required|string|max:255',
            'desc' => 'nullable'
        ]);
        if ($validation->fails()) {
            $response = [
                'status' => 400,
                'message' => $validation->errors()
            ];
            return $response;
        }

        $activity->update($data);

        $response = [
            'status' => 200,
            'message' => 'success'
        ];
        return $response;
    }

    public function deleteData($id)
    {
        $activity = $this->where('id', $id)->first();
        if (! $activity) {
            $response = [
                'status' => 404,
                'message' => 'not found'
            ];
            return $response;
        }

        $activity->delete();

        $response = [
            'status' => 200,
            'message' => 'success'
        ];
        return $response;
    }
}
