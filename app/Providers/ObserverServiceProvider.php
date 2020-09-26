<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\Admin\CategoryObserver;
use App\Observers\Admin\PageObserver;
use App\Observers\Admin\ArticleObserver;
use App\Models\Page;
use App\Models\Articles\Article;
use App\Models\Articles\Category;

/**
 * Class ObserverServiceProvider.
 */
class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     */
    public function boot()
    {
        Page::observe(PageObserver::class);
        Category::observe(CategoryObserver::class);
        Article::observe(ArticleObserver::class);
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        //
    }
}
