<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    final public function index(Request $request)
    {
        //dd($request->all());
        $categories = (new SubCategory())->pluckCategories();

        $query = (new Post())->postListDashboard($request);

        if (Auth::user()->role == User::USER) {
            $query->where('user_id', Auth::id());
        }
        $posts = $query->paginate(10);

        if ($request->ajax()) {
            //only show the rendered table
            return view('backend.modules.post.table', compact('posts'))->render();
        }

        return view('backend.modules.post.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category_data = (new Post())->pluckCategories();
        $tag_data = (new Post())->selectTags();

        return view('backend.modules.post.create', compact('category_data', 'tag_data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostStoreRequest $request)
    {

        $post = $request->except(['tag_ids', 'photo']);
        $post['slug'] = Str::slug($request->input('slug'));
        $post['user_id'] = Auth::user()->id;
        $post['is_approved'] = 1;

        if ($request->hasFile('photo')) {

            $file = $request->file('photo');
            $name = Str::slug($request->input('slug'));
            $height = 400;
            $width = 1000;

            $thumb_height = 150;
            $thumb_width = 300;

            $path = 'images/post/original/';
            $thumb_path = 'images/post/thumbnail/';

            $post['photo'] = PhotoUploadController::imageUpload($name, $height, $width, $path, $file);
            PhotoUploadController::imageUpload($name, $thumb_height, $thumb_width, $thumb_path, $file);
        }

        $post = (new Post())->createPost($post);

        $post->tag()->attach($request->input('tag_ids'));

        session()->flash('msg', 'Post created successfully !');
        session()->flash('notification_color', 'success');

        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {

        if (Auth::user()->role == User::USER && $post->user_id != Auth::id()) {
            return abort(403);
        }

        $post->load(['category', 'sub_category', 'user', 'tag']);
        return view('backend.modules.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $category_data = (new Post())->pluckCategories();
        $tag_data = (new Post())->selectTags();

        $selected_tags = (new Post())->markedTags($post->id);

        /* another way to load selected tags
        $post->load('tag');
        $selected_tags = $post->tag->pluck('id')->toArray(); */

        return view('backend.modules.post.edit', compact('post', 'category_data', 'tag_data', 'selected_tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        $upPost = $request->except(['tag_ids', 'photo']);
        $upPost['slug'] = Str::slug($request->input('slug'));
        $upPost['user_id'] = Auth::user()->id;
        $upPost['is_approved'] = 1;

        if ($request->hasFile('photo')) {

            $file = $request->file('photo');
            $name = Str::slug($request->input('slug'));
            $height = 400;
            $width = 1000;

            $thumb_height = 150;
            $thumb_width = 300;

            $path = 'images/post/original/';
            $thumb_path = 'images/post/thumbnail/';

            PhotoUploadController::imageUnlink($path, $post->photo);
            PhotoUploadController::imageUnlink($thumb_path, $post->photo);

            $upPost['photo'] = PhotoUploadController::imageUpload($name, $height, $width, $path, $file);
            PhotoUploadController::imageUpload($name, $thumb_height, $thumb_width, $thumb_path, $file);
        }

        (new Post())->updatePost($post, $upPost);

        $post->tag()->sync($request->input('tag_ids'));

        session()->flash('msg', 'Post updated successfully !');
        session()->flash('notification_color', 'success');

        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $path = 'images/post/original/';
        $thumb_path = 'images/post/thumbnail/';

        PhotoUploadController::imageUnlink($path, $post->photo);
        PhotoUploadController::imageUnlink($thumb_path, $post->photo);

        (new Post())->deletePost($post);

        session()->flash('msg', 'Post deleted successfully !');
        session()->flash('notification_color', 'success');

        return redirect()->route('post.index');
    }
}
