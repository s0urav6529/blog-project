<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\SubCategoryStoreRequest;
use App\Http\Requests\SubCategoryUpdateRequest;
use Psy\Readline\Hoa\Console;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $categories = (new SubCategory())->pluckCategories();

        $subCategories = (new SubCategory())->subCatListDashboard($request)->paginate(10);

        if ($request->ajax()) {
            //only show the rendered table
            return view('backend.modules.sub_category.table', compact('subCategories'))->render();
        }

        return view('backend.modules.sub_category.index', compact('subCategories', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category_data = (new SubCategory())->pluckCategories();
        return view('backend.modules.sub_category.create', compact('category_data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubCategoryStoreRequest $request)
    {
        $subCategory = $request->all();
        $subCategory['slug'] = Str::slug($request->input('slug'));

        (new SubCategory())->createSubCat($subCategory);

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
        $category_data = (new SubCategory())->pluckCategories();
        return view('backend.modules.sub_category.edit', compact('subCategory', 'category_data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubCategoryUpdateRequest $request, SubCategory $subCategory)
    {
        $upSubCategory = $request->all();
        $upSubCategory['slug'] = Str::slug($request->input('slug'));

        (new SubCategory())->updateSubCat($subCategory, $upSubCategory);

        session()->flash('msg', 'Sub-category updated successfully !');
        session()->flash('notification_color', 'success');

        return redirect()->route('sub-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subCategory)
    {
        (new SubCategory())->deleteSubCat($subCategory);

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
