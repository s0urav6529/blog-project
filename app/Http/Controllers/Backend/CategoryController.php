<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Resources\CategoryListResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $category_data = (new Category())->catListDashboard($request)->paginate(10);
        return view('backend.modules.category.index', compact('category_data'));
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
        $category = $request->all();
        $category['slug'] = Str::slug($request->input('slug'));

        (new Category())->createCategory($category);

        session()->flash('msg', 'Category created successfully !');
        session()->flash('notification_color', 'success');

        return redirect()->route('category.index');
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

        $upCategory = $request->all();
        $upCategory['slug'] = Str::slug($request->input('slug'));

        (new Category())->updateCategory($category, $upCategory);

        session()->flash('msg', 'Category updated successfully !');
        session()->flash('notification_color', 'success');

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {

        (new Category())->deleteCategory($category);

        session()->flash('msg', 'Category deleted successfully !');
        session()->flash('notification_color', 'error');

        return redirect()->route('category.index');
    }


    //this function for api

    final public function getCategories()
    {

        $categories = Category::where('status', 1)->latest()->get();
        return CategoryListResource::collection($categories);
    }

    final public function categoryDetails(int $id)
    {

        $category = Category::findOrFail($id);
        //@for single data
        return new CategoryListResource($category);
    }

    final public function categoryStore(CategoryStoreRequest $request)
    {
        Category::create($request->all());
        return response()->json(['msg' => 'Category created successfully !']);
    }

    final public function categoryUpdate(CategoryUpdateRequest $request, int $id)
    {

        $category_data = $request->all();
        $category_data['slug'] = Str::slug($request->input('slug'));

        $category = Category::findOrFail($id);

        $category->update($category_data);

        return response()->json(['msg' => 'Category updated successfully !']);
    }

    final public function categoryDelete(int $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return response()->json(['msg' => 'Category deleted successfully !']);
    }
}
