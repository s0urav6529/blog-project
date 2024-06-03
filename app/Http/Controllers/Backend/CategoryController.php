<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Collection;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category_data = Category::orderBy('order_by')->get();
        return \view('backend.modules.category.index', compact('category_data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.modules.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
        $category_data = $request->all();
        $category_data['slug'] = Str::slug($request->input('slug'));

        Category::create($category_data);

        \session()->flash('msg', 'Categoey created successfully');
        \session()->flash('notification_color', 'success');

        return \redirect()->route('category.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('backend.modules.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('backend.modules.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {

        $category_data = $request->all();
        $category_data['slug'] = Str::slug($request->input('slug'));

        $category->update($category_data);

        \session()->flash('msg', 'Categoey updated successfully');
        \session()->flash('notification_color', 'success');

        return \redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}