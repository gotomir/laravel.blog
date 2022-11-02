<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        view()->composer('layouts.layout', function ($view) {
$view->with('categories_for_H', Category::withCount('posts')->get());
        });
        view()->composer('layouts.category_layout', function ($view) {
$view->with('categories_for_H', Category::all());
        });
        view()->composer('layouts.sidebar', function ($view) {
$view->with('popular_posts', Post::orderBy('views', 'desc')->limit(4)->get());
        });
    }
}
