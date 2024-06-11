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
        $post_data = Post::with('tag', 'category', 'sub_category', 'user')->where('is_approved', 1)->where('status', 1)->latest()->take(5)->get();
        return view('frontend.modules.index', compact('post_data'));
    }

    public function single()
    {
        return view('frontend.modules.single');
    }
}
