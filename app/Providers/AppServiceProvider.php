<?php

namespace App\Providers;

use App\Repository\Category\CategoryEloquent;
use App\Repository\Category\CategoryRepo;
use App\Repository\Config\ConfigInformationEloquent;
use App\Repository\Config\ConfigInformationRepo;
use App\Repository\Config\UserEloquent;
use App\Repository\Config\UserRepo;
use App\Repository\Feedback\FeedbackEloquent;
use App\Repository\Feedback\FeedbackRepo;
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
        $this->app->bind(ConfigInformationRepo::class, ConfigInformationEloquent::class);
        $this->app->bind(UserRepo::class, UserEloquent::class);
        $this->app->bind(FeedbackRepo::class, FeedbackEloquent::class);
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
