<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $guarded = [];

    /* database queries */
    public function tagListDashboard(Request $request)
    {
        $query = self::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('order_by')) {
            $query->orderBy('order_by', $request->order_by);
        } else {
            //default ascending
            $query->orderBy('order_by', 'asc');
        }

        return $query;
    }

    public function tagListFrontend(bool $isActive = false)
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
