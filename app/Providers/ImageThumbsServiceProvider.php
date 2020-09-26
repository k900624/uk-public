<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ImageThumbsServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('imageThumb', 'App\Services\Image\Image');
    }
}
