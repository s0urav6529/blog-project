<?php

namespace App\Providers;

use App\Models\Category;
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

        $category_data = Category::with('sub_category')->where('status', 1)->orderBy('order_by')->get();
        $tag_data = Tag::where('status', 1)->orderBy('order_by')->get();
        View::share(['category_data' => $category_data, 'tag_data' => $tag_data]);
        Paginator::useBootstrap();
    }
}
