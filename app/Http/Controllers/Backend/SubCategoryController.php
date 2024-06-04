<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\SubCategoryStoreRequest;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategory_data = SubCategory::with('category')->orderBy('order_by')->get();
        return view('backend.modules.sub_category.index', compact('subcategory_data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category_data = Category::pluck('name', 'id');
        return view('backend.modules.sub_category.create', compact('category_data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubCategoryStoreRequest $request)
    {
        $subcategory_data = $request->all();
        $subcategory_data['slug'] = Str::slug($request->input('slug'));

        SubCategory::create($subcategory_data);

        \session()->flash('msg', 'Sub-category created successfully !');
        \session()->flash('notification_color', 'success');

        return \redirect()->route('sub-category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $subCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subCategory)
    {
        //
    }
}
