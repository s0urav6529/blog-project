<?php

namespace App\Models;

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
    public function subCatList($withCategory = false)
    {
        $query = self::query();

        if ($withCategory) {
            $query->with('category');
        }
        return $query->orderBy('order_by', 'asc');
    }

    public function pluckCategories()
    {
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
