<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    /* relations */
    public function tag()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comment()
    {
        return $this->hasMany(Comment::class)->whereNull('comment_id')->orderBy('created_at', 'desc');
    }

    public function post_count()
    {
        return $this->hasOne(PostCount::class);
    }

    /* database queries */

    public function postList(
        bool $withCat,
        bool $withSubCat,
        bool $withUser,
        bool $withTag,
        bool $isApproved,
        bool $isActive
    ) {

        $query = self::query();

        if ($withCat) {
            $query->with('category');
        }

        if ($withSubCat) {
            $query->with('sub_category');
        }

        if ($withUser) {
            $query->with('user');
        }

        if ($withTag) {
            $query->with('tag');
        }

        if ($isApproved) {
            $query->where('is_approved', 1);
        }

        if ($isActive) {
            $query->where('status', 1);
        }

        return $query->latest();
    }

    public function postListDashboard(Request $request)
    {

        $query = self::query();

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('sub_category')) {
            $query->where('sub_category_id', $request->sub_category);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('approval')) {
            $query->where('is_approved', $request->approval);
        }

        if ($request->filled('tags')) {

            $tags = json_decode($request->tags, true);

            $query->whereHas('tag', function ($q) use ($tags) {
                $q->whereIn('tags.id', $tags);
            }, '=', count($tags));
        }


        return $query;
    }

    public function postOwnerId(int $post_id)
    {
        return self::where('id', $post_id)->value('user_id');
    }


    public function pluckCategories()
    {
        return (new Category())->catListFrontend(false, true)->pluck('name', 'id');
    }

    public function selectTags()
    {
        return (new Tag())->tagListFrontend(true)->select('name', 'id')->get();
    }

    public function markedTags($post_id)
    {
        return DB::table('post_tag')->where('post_id', $post_id)->pluck('tag_id')->toArray();
    }

    public function createPost($post)
    {
        return self::create($post);
    }

    public function updatePost($post, $upPost)
    {
        $post->update($upPost);
    }

    public function deletePost($post)
    {
        $post->delete();
    }
}
