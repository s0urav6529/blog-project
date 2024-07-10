<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        $category_data = (new Category())->getCategories($withSubCategory = true, $isActive = true)->get();

        $tag_data = Tag::where('status', 1)->orderBy('order_by')->get();
        $recent_posts = Post::where('is_approved', 1)->where('status', 1)->latest()->limit(5)->get();

        View::share(['category_data' => $category_data, 'tag_data' => $tag_data, "recent_posts" => $recent_posts]);

        Paginator::useBootstrap();
    }
}
