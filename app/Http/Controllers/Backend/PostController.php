<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostStoreRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $post_data = Post::orderBy('order_by')->get();
        return view('backend.modules.post.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category_data = Category::where('status', 1)->pluck('name', 'id');
        $tag_data = Tag::where('status', 1)->select('name', 'id')->get();
        return view('backend.modules.post.create', compact('category_data', 'tag_data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostStoreRequest $request)
    {

        $post_data = $request->except(['tag_ids', 'photo']);
        $post_data['slug'] = Str::slug($request->input('slug'));
        $post_data['user_id'] = Auth::user()->id;
        $post_data['is_approved'] = 1;

        if ($request->hasFile('photo')) {

            $file = $request->file('photo');
            $name = Str::slug($request->input('slug'));
            $height = 400;
            $width = 1000;

            $thumb_height = 150;
            $thumb_width = 300;

            $path = 'images/post/original/';
            $thumb_path = 'images/post/thumbnail/';

            $post_data['photo'] = PhotoUploadController::imageUpload($name, $height, $width, $path, $file);
            PhotoUploadController::imageUpload($name, $thumb_height, $thumb_width, $thumb_path, $file);
        }

        //dd($post_data);
        $post = Post::create($post_data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('backend.modules.post.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('backend.modules.post.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
