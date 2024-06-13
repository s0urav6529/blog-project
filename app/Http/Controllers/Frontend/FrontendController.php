<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $query = Post::with('tag', 'category', 'sub_category', 'user')->where('is_approved', 1)->where('status', 1);

        $post_data = $query->latest()->take(5)->get();
        $slider_post = $query->inRandomOrder()->take(6)->get();

        return view('frontend.modules.index', compact('post_data', 'slider_post'));
    }

    public function all_post()
    {

        $post_data = Post::with('tag', 'category', 'sub_category', 'user')->where('is_approved', 1)->where('status', 1)->latest()->paginate(10);
        return view('frontend.modules.all_post', compact('post_data'));
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

        return view('frontend.modules.all_post', compact('post_data'));
    }
}
