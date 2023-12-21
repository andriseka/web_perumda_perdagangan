<?php

namespace App\Models;

use App\Traits\Pagination;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory, Pagination;

    protected $table = 'posts';
    protected $fillable = [
        'title', 'slug', 'post_category_id', 'content', 'image'
    ];

    public function getByLimit($limit)
    {
        $posts = $this->join('post_categories', 'posts.post_category_id', '=', 'post_categories.id')
                    ->select(
                        'posts.title', 'posts.slug', 'posts.image', 'post_categories.name as category',
                        'posts.content'
                    )->orderBy('posts.created_at', 'desc')
                    ->take($limit)
                    ->get();

        $remapp = [];
        foreach ($posts as $value) {
            if ($value->image !== null) {
                $image = asset('uploads/post/'.$value->image);
            } else {
                $image = null;
            }
            $data = [
                'title' => $value->title,
                'slug' => $value->slug,
                'image' => $image,
                'short_desc' => substr($value->content, 0, 90),
                'category' => $value->category
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
        $posts = $this->join('post_categories', 'posts.post_category_id', '=', 'post_categories.id')
                    ->select('title', 'posts.slug', 'post_categories.name as category', 'posts.image', 'posts.content')
                    ->orderBy('posts.created_at', 'desc')
                    ->paginate(10);

        $remapp = [];
        foreach ($posts as $key => $value) {
            if ($value->image !== null) {
                $image = asset('uploads/post/'.$value->image);
            } else {
                $image = null;
            }
            $data = [
                'no' => $key + $posts->firstitem(),
                'title' => $value->title,
                'slug' => $value->slug,
                'image' => $image,
                'short_desc' => substr($value->content,0,90),
                'category' => $value->category
            ];
            array_push($remapp, $data);
        }

        $pagination = $this->pagination($posts->total(), $posts->perPage(), $posts->currentPage(), $posts->lastPage());

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
            'title' => 'required|string|max:255|unique:posts,title,',
            'post_category_id' => 'required|exists:post_categories,id',
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
            $image->move(public_path('uploads/post'), $newImage);
        } else {
            $newImage = null;
        }

        $data['image'] = $newImage;
        $data['slug'] = Str::slug($data['title']);

        $this->create($data);

        $category = DB::table('post_categories')->where('id', $data['post_category_id'])->first();

        DB::table('post_categories')->where('id', $data['post_category_id'])->update([
            'count' => $category->count + 1
        ]);

        $response = [
            'status' => 201,
            'message' => 'success'
        ];
        return $response;
    }

    public function getDetail($slug)
    {
        $post = $this->where('slug', $slug)->first();
        if (! $post) {
            $response = [
                'status' => 404,
                'message' => 'not found'
            ];
            return $response;
        }

        if ($post->image !== null) {
            $post->image  = asset('uploads/post/'.$post->image);
        } else {
            $post->image = null;
        }

        $response = [
            'status' => 200,
            'data' => $post
        ];
        return $response;
    }

    public function getByCategory($category_slug)
    {
        $category = DB::table('post_categories')->where('slug', $category_slug)->first();
        $posts = $this->where('post_category_id', $category->id)->orderBy('created_at', 'desc')->paginate(12);
        $remapp = [];
        foreach ($posts as $key => $value) {
            if ($value->image !== null) {
                $image = asset('uploads/post/'.$value->image);
            } else {
                $image = null;
            }
            $data = [
                'no' => $key + $posts->firstitem(),
                'title' => $value->title,
                'slug' => $value->slug,
                'image' => $image,
                'short_desc' => substr($value->content,0,90),
            ];
            array_push($remapp, $data);
        }

        $pagination = $this->pagination($posts->total(), $posts->perPage(), $posts->currentPage(), $posts->lastPage());

        $response = [
            'status' => 200,
            'data' => $remapp,
            'category' => $category->name,
            'pagination' => $pagination
        ];
        return $response;

    }

    public function updateData(array $data, $slug)
    {
        $post = $this->where('slug', $slug)->first();
        $validation = Validator::make($data, [
            'title' => 'required|string|max:255|unique:posts,title,'.$post->id,
            'post_category_id' => 'required|exists:post_categories,id',
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
            $image->move(public_path('uploads/post'), $newImage);
            if ($post->image !== null) {
                File::delete(public_path('uploads/post/'.$post->image));
            }
        } else {
            $newImage = $post->image;
        }

        $data['image'] = $newImage;
        $data['slug'] = Str::slug($data['title']);

        if ($post->post_category_id !== $data['post_category_id']) {
            $category = DB::table('post_categories')->where('id', $data['post_category_id'])->first();
            DB::table('post_categories')->where('id', $data['post_category_id'])->update([
                'count' => $category->count + 1
            ]);

            $category1 = DB::table('post_categories')->where('id', $post->post_category_id)->first();
            DB::table('post_categories')->where('id', $post->post_category_id)->update([
                'count' => $category1->count - 1
            ]);
        }

        $post->update($data);

        $response = [
            'status' => 200,
            'message' => 'success'
        ];
        return $response;
    }

    public function deleteData($slug)
    {
        $post = $this->where('slug', $slug)->first();
        $category1 = DB::table('post_categories')->where('id', $post->post_category_id)->first();
        DB::table('post_categories')->where('id', $post->post_category_id)->update([
            'count' => $category1->count - 1
        ]);

        if ($post->image !== null) {
            File::delete(public_path('uploads/post/'.$post->image));
        }

        $post->delete();

        $response = [
            'status' => 200,
            'message' => 'success'
        ];
        return $response;
    }
}
