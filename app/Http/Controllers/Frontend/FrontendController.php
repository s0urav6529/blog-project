<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PostCountController;
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
        $query = Post::with('sub_category', 'category', 'tag', 'user', 'post_count', 'comment')->where('is_approved', 1)->where('status', 1);

        $post_data = $query->latest()->take(5)->get();
        $slider_post = $query->inRandomOrder()->take(6)->get();

        return view('frontend.modules.index', compact('post_data', 'slider_post'));
    }

    /* For all post show */
    public function all_post()
    {

        $post_data = Post::with('sub_category', 'category', 'tag', 'user', 'post_count', 'comment')->where('is_approved', 1)->where('status', 1)->latest()->paginate(10);

        $title = 'All post';
        $sub_title = 'You Can read...';

        return view('frontend.modules.all_post', compact('post_data', 'title', 'sub_title'));
    }

    /* For single post details show */
    final public function single(string $slug)
    {

        $post = Post::with('category', 'sub_category', 'tag', 'user', 'comment', 'comment.user', 'comment.reply', 'post_count')
            ->where('slug', $slug)
            ->first();

        if ($post) {

            $title = 'Post Details';
            $sub_title = $post->title;

            return view('frontend.modules.single', compact('post', 'title', 'sub_title'));
        } else {
            abort(404);
        }
    }

    final public function postReadCount(int $post_id)
    {
        (new PostCountController($post_id))->postReadCount();
    }


    final public function contact_us()
    {
        $title = 'Contact Us';
        $sub_title = 'Feel free to...';
        return view('frontend.modules.contact_us', compact('title', 'sub_title'));
    }

    final public function about_us()
    {
        $title = 'About Us';
        $sub_title = 'Know More...';
        return view('frontend.modules.about_us', compact('title', 'sub_title'));
    }

    final public function notification()
    {

        return view('frontend.modules.notification');
    }

    /* For search */
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

    /* For category wise show */
    public function category($slug)
    {

        $category = Category::where('slug', $slug)->firstOrFail();

        $title = $category->name;
        $sub_title = 'Post by category';

        $post_data = Post::with('category', 'sub_category', 'user', 'tag')
            ->where('is_approved', 1)
            ->where('status', 1)
            ->where('category_id', $category->id)
            ->latest()
            ->paginate(10);

        return view('frontend.modules.all_post', compact('post_data', 'title', 'sub_title'));
    }

    /* For sub-category wise show */
    public function sub_category($cat_slug, $sub_cat_slug)
    {

        $sub_category = SubCategory::where('slug', $sub_cat_slug)->firstOrFail();

        $title = $sub_category->name;
        $sub_title = 'Post by sub category';

        $post_data = Post::with('category', 'sub_category', 'user', 'tag')
            ->where('is_approved', 1)
            ->where('status', 1)
            ->where('sub_category_id', $sub_category->id)
            ->latest()
            ->paginate(10);

        return view('frontend.modules.all_post', compact('post_data', 'title', 'sub_title'));
    }

    /* For tag wise show */
    public function tag($slug)
    {

        $tag = Tag::where('slug', $slug)->first();

        if ($tag) {

            $post_ids = DB::table('post_tag')->where('tag_id', $tag->id)->distinct('post_id')->pluck('post_id');

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
            abort(404);
        }
    }
}
