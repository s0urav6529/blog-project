<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\SubCategoryStoreRequest;
use App\Http\Requests\SubCategoryUpdateRequest;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategory_data = SubCategory::with('category')->orderBy('order_by')->paginate(10);
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

        session()->flash('msg', 'Sub-category created successfully !');
        session()->flash('notification_color', 'success');

        return redirect()->route('sub-category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $subCategory)
    {
        $subCategory->load('category');
        return view('backend.modules.sub_category.show', compact('subCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $subCategory)
    {
        $category_data = Category::pluck('name', 'id');
        return view('backend.modules.sub_category.edit', compact('subCategory', 'category_data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubCategoryUpdateRequest $request, SubCategory $subCategory)
    {
        $subcategory_data = $request->all();
        $subcategory_data['slug'] = Str::slug($request->input('slug'));

        $subCategory->update($subcategory_data);

        session()->flash('msg', 'Sub-category updated successfully !');
        session()->flash('notification_color', 'success');

        return redirect()->route('sub-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subCategory)
    {
        $subCategory->delete();
        session()->flash('msg', 'Sub-categoey deleted successfully !');
        session()->flash('notification_color', 'error');

        return redirect()->route('sub-category.index');
    }

    public function getCategoryWiseSubCategory(int $categoryId)
    {
        $subcategory_data = SubCategory::select('name', 'id')->where('status', 1)->where('category_id', $categoryId)->get();
        return response()->json($subcategory_data);
    }
}
