<?php

namespace App\Models;

use App\Traits\Pagination;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class Award extends Model
{
    use HasFactory, Pagination;

    protected $table = 'awards';
    protected $fillable = [
        'title', 'slug', 'award_category_id', 'content', 'image'
    ];

    public function getData()
    {
        $award = $this->join('award_categories', 'awards.award_category_id', '=', 'award_categories.id')
                    ->select('title', 'awards.slug', 'awards.content', 'award_categories.name as category', 'awards.image')
                    ->orderBy('awards.created_at', 'desc')
                    ->paginate(12);

        $remapp = [];
        foreach ($award as $key => $value) {
            $data = [
                'no' => $key + $award->firstitem(),
                'title' => $value->title,
                'slug' => $value->slug,
                'category' => $value->category,
                'short_desc' => substr($value->content, 0, 90),
                'image' => asset('uploads/award/'.$value->image)
            ];
            array_push($remapp, $data);
        }

        $pagination = $this->pagination($award->total(), $award->perPage(), $award->currentPage(), $award->lastPage());

        $response = [
            'status' => 200,
            'data' => $remapp,
            'pagination' => $pagination
        ];
        return $response;
    }

    public function getDetail($slug)
    {
        $award = $this->where('slug', $slug)->first();
        if (! $award) {
            $response = [
                'status' => 404,
                'message' => 'not found'
            ];
            return $response;
        }

        if ($award->image !== null) {
            $award->image  = asset('uploads/award/'.$award->image);
        } else {
            $award->image = null;
        }

        $response = [
            'status' => 200,
            'data' => $award
        ];
        return $response;
    }

    public function getByCategory($category_slug)
    {
        $category = DB::table('award_categories')->where('slug', $category_slug)->first();
        $award = $this->where('award_category_id', $category->id)->orderBy('created_at', 'desc')->paginate(10);
        $remapp = [];
        foreach ($award as $key => $value) {
            $data = [
                'no' => $key + $award->firstitem(),
                'title' => $value->title,
                'slug' => $value->slug,
                'short_desc' => substr($value->content, 0, 90),
                'image' => asset('uploads/award/'.$value->image)
            ];
            array_push($remapp, $data);
        }

        $pagination = $this->pagination($award->total(), $award->perPage(), $award->currentPage(), $award->lastPage());

        $response = [
            'status' => 200,
            'data' => $remapp,
            'category' => $category->name,
            'pagination' => $pagination
        ];
        return $response;
    }

    public function storeData(array $data)
    {
        $validation = Validator::make($data, [
            'title' => 'required|string|max:255|unique:awards,title,',
            'award_category_id' => 'required|exists:award_categories,id',
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
            $image->move(public_path('uploads/award'), $newImage);
        } else {
            $newImage = null;
        }

        $data['image'] = $newImage;
        $data['slug'] = Str::slug($data['title']);

        $this->create($data);

        $category = DB::table('award_categories')->where('id', $data['award_category_id'])->first();

        DB::table('award_categories')->where('id', $data['award_category_id'])->update([
            'count' => $category->count + 1
        ]);

        $response = [
            'status' => 201,
            'message' => 'success'
        ];
        return $response;
    }

    public function updateData(array $data, $slug)
    {
        $award = $this->where('slug', $slug)->first();
        $validation = Validator::make($data, [
            'title' => 'required|string|max:255|unique:awards,title,'.$award->id,
            'award_category_id' => 'required|exists:award_categories,id',
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
            $image->move(public_path('uploads/award'), $newImage);
            if ($award->image !== null) {
                File::delete(public_path('uploads/award/'.$award->image));
            }
        } else {
            $newImage = $award->image;
        }

        $data['image'] = $newImage;
        $data['slug'] = Str::slug($data['title']);

        if ($award->award_category_id !== $data['award_category_id']) {
            $category = DB::table('award_categories')->where('id', $data['award_category_id'])->first();
            DB::table('award_categories')->where('id', $data['award_category_id'])->update([
                'count' => $category->count + 1
            ]);

            $category1 = DB::table('award_categories')->where('id', $award->award_category_id)->first();
            DB::table('award_categories')->where('id', $award->award_category_id)->update([
                'count' => $category1->count - 1
            ]);
        }

        $award->update($data);

        $response = [
            'status' => 200,
            'message' => 'success'
        ];
        return $response;
    }

    public function deleteData($slug)
    {
        $award = $this->where('slug', $slug)->first();
        $category1 = DB::table('award_categories')->where('id', $award->award_category_id)->first();
        DB::table('award_categories')->where('id', $award->award_category_id)->update([
            'count' => $category1->count - 1
        ]);

        if ($award->image !== null) {
            File::delete(public_path('uploads/award/'.$award->image));
        }

        $award->delete();

        $response = [
            'status' => 200,
            'message' => 'success'
        ];
        return $response;
    }
}
