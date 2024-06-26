<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\SubCategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    public function index()
    {
        $query = Post::with('sub_category', 'category', 'tag', 'user')->where('is_approved', 1)->where('status', 1);

        $post_data = $query->latest()->take(5)->get();
        $slider_post = $query->inRandomOrder()->take(6)->get();

        return view('frontend.modules.index', compact('post_data', 'slider_post'));
    }

    public function all_post()
    {

        $post_data = Post::with('sub_category', 'category', 'tag', 'user')->where('is_approved', 1)->where('status', 1)->latest()->paginate(10);

        $title = 'All post';
        $sub_title = '';

        return view('frontend.modules.all_post', compact('post_data', 'title', 'sub_title'));
    }

    public function single()
    {
        return view('frontend.modules.single');
    }

    public function search(Request $request)
    {

        $post_data = Post::with('category', 'sub_category', 'user', 'tag')
            ->where('is_approved', 1)
            ->where('status', 1)
            ->where('title', 'like', '%' . $request->input('search') . '%')
            ->latest()
            ->paginate(10);

        $title = 'View search result';
        $sub_title = $request->input('search');

        return view('frontend.modules.all_post', compact('post_data', 'title', 'sub_title'));
    }

    public function category($slug)
    {

        $category = Category::where('slug', $slug)->first();

        if ($category) {

            $title = $category->name;
            $sub_title = 'Post by category';

            $post_data = Post::with('category', 'sub_category', 'user', 'tag')
                ->where('is_approved', 1)
                ->where('status', 1)
                ->where('category_id', $category->id)
                ->latest()
                ->paginate(10);

            return view('frontend.modules.all_post', compact('post_data', 'title', 'sub_title'));
        } else {
            //@make an error message
        }
    }

    public function sub_category($cat_slug, $sub_cat_slug)
    {

        $sub_category = SubCategory::where('slug', $sub_cat_slug)->first();

        if ($sub_category) {

            $title = $sub_category->name;
            $sub_title = 'Post by sub category';

            $post_data = Post::with('category', 'sub_category', 'user', 'tag')
                ->where('is_approved', 1)
                ->where('status', 1)
                ->where('sub_category_id', $sub_category->id)
                ->latest()
                ->paginate(10);

            return view('frontend.modules.all_post', compact('post_data', 'title', 'sub_title'));
        } else {
            //@make an error message
        }
    }

    public function tag($slug)
    {

        $tag = Tag::where('slug', $slug)->first();

        $post_ids = DB::table('post_tag')->where('tag_id', $tag->id)->distinct('post_id')->pluck('post_id');

        if ($tag) {

            $title = $tag->name;
            $sub_title = 'Post by tag';

            $post_data = Post::with('category', 'sub_category', 'user', 'tag')
                ->where('is_approved', 1)
                ->where('status', 1)
                ->whereIn('id', $post_ids)
                ->latest()
                ->paginate(10);

            return view('frontend.modules.all_post', compact('post_data', 'title', 'sub_title'));
        } else {
            //@make an error message
        }
    }
}
