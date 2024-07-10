<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $guarded = [];

    /* database queries */
    public function tagList(bool $isActive = false)
    {
        $query = self::query();

        if ($isActive) {
            $query->where('status', 1);
        }
        return $query->orderBy('order_by', 'asc');
    }

    public function createTag($tag)
    {
        self::create($tag);
    }

    public function updateTag($tag, $upTag)
    {
        $tag->update($upTag);
    }

    public function deleteTag($tag)
    {
        $tag->delete();
    }
}
