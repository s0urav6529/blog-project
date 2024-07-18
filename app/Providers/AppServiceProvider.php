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

        $category_data = (new Category())->catListFrontend(true, true)->get();

        $tag_data = (new Tag())->tagListFrontend(true)->get();

        $recent_posts = (new Post())->postList(false, false, false, false, true, true)->limit(5)->get();

        View::share(['category_data' => $category_data, 'tag_data' => $tag_data, "recent_posts" => $recent_posts]);

        Paginator::useBootstrap();
    }
}
