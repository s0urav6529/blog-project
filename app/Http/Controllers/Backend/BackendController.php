<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\SubCategory;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class BackendController extends Controller
{
    public function index()
    {

        $admins = User::where('role', 1)->get()->count();
        $users = User::where('role', 2)->get()->count();
        $published_posts = Post::where('is_approved', 1)->get()->count();
        $unpublished_posts = Post::where('is_approved', 0)->get()->count();
        $active_category = Category::where('status', 1)->get()->count();
        $inactive_category = Category::where('status', 0)->get()->count();
        $active_subcategory = SubCategory::where('status', 1)->get()->count();
        $inactive_subcategory = SubCategory::where('status', 0)->get()->count();
        $active_tags = Tag::where('status', 1)->get()->count();
        $inactive_tags = Tag::where('status', 0)->get()->count();


        return view('backend.modules.index', compact(
            'admins',
            'users',
            'published_posts',
            'unpublished_posts',
            'active_category',
            'inactive_category',
            'active_subcategory',
            'inactive_subcategory',
            'active_tags',
            'inactive_tags'
        ));
    }
}
