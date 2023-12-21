<?php

namespace App\Http\Controllers\Website\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $post;
    protected $category;

    public function __construct(Post $post, PostCategory $category)
    {
        $this->post = $post;
        $this->category = $category;
    }

    public function index()
    {
        $data = $this->post->getData();
        $category = $this->category->getAll()['data'];
        return view('website.post.post', compact('data', 'category'));
    }

    public function detail($slug)
    {
        $post = $this->post->getDetail($slug)['data'];
        return view('website.post.detail', compact('post'));
    }

    public function get_by_category($category_slug)
    {
        $data = $this->post->getByCategory($category_slug);
        $category = $this->category->getAll()['data'];
        return view('website.post.post_category', compact('data', 'category'));
    }
}
