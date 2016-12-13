<?php

namespace App\Providers;

use App\Repository\Category\CategoryEloquent;
use App\Repository\Category\CategoryRepo;
use App\Repository\Post\PostEloquent;
use App\Repository\Post\PostRepo;
use App\Repository\Tag\TagEloquent;
use App\Repository\Tag\TagRepo;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(CategoryRepo::class, CategoryEloquent::class);
        $this->app->bind(PostRepo::class, PostEloquent::class);
        $this->app->bind(TagRepo::class, TagEloquent::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
