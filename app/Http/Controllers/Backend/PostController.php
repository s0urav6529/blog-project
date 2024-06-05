<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\SubCategory;
use Illuminate\Http\Request;


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
        $category_data = Category::pluck('name', 'id');
        $subCategory_data = SubCategory::pluck('name', 'id');
        return view('backend.modules.post.create', compact('category_data', 'subCategory_data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
