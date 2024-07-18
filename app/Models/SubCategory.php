<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    /* relations */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /* database queries */

    public function subCatListDashboard(Request $request)
    {
        $query = self::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('order_by')) {
            $query->orderBy('order_by', $request->order_by);
        } else {
            //default ascending
            $query->orderBy('order_by', 'asc');
        }

        return $query;
    }

    public function subCatListFrontend($withCategory = false)
    {
        $query = self::query();

        if ($withCategory) {
            $query->with('category');
        }
        return $query->orderBy('order_by', 'asc');
    }

    public function pluckCategories()
    {
        /* $data = Category::pluck('name', 'id');
        dd($data); */
        return Category::pluck('name', 'id');
    }

    public function createSubCat($subCategory)
    {
        self::create($subCategory);
    }

    public function updateSubCat($subCategory, $upSubCategory)
    {
        $subCategory->update($upSubCategory);
    }

    public function deleteSubCat($subCategory)
    {
        $subCategory->delete();
    }
}
