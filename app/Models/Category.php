<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];


    /* relations */
    public function sub_category()
    {
        return $this->hasMany(SubCategory::class);
    }

    /* database queries */
    public function getCategories(bool $withSubCategory = false, bool $isActive = false)
    {
        $query = self::query();

        if ($withSubCategory) {
            $query->with('sub_category');
        }

        if ($isActive) {
            $query->where('status', 1);
        }
        return $query->orderBy('order_by', 'asc');
    }

    public function createCategory($category)
    {
        self::create($category);
    }

    public function updateCategory($category, $upCategory)
    {
        $category->update($upCategory);
    }

    public function deleteCategory($category)
    {
        $category->delete();
    }
}
