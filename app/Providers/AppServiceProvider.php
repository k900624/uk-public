<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Set the default string length for Laravel5.4
        // https://laravel-news.com/laravel-5-4-key-too-long-error
        Schema::defaultStringLength(191);

        date_default_timezone_set(config('app.timezone'));

        // my settings
        // config('settings.key')
        if (Schema::hasTable('settings')) {
            config([
                'settings' => Setting::all([
                    'key', 'value'
                ])
                ->keyBy('key')
                ->transform(function ($setting) {
                    return $setting->value;
                })
                ->toArray()
            ]);
        }

        $this->registerBladeExtensions();
    }

    /**
     * Register the blade extender to use new blade sections.
     */
    protected function registerBladeExtensions()
    {
        /*
         * Role based blade extensions
         * Accepts either string of Role Name or Role ID
         */
        Blade::directive('hasrole', function ($role) {
            return "<?php if (access()->hasRole({$role})): ?>";
        });
        
        /*
         * Permission based blade extensions
         * Accepts wither string of Permission Name or Permission ID
         */
        Blade::directive('haspermission', function ($permission) {
            return "<?php if (access()->allow({$permission})): ?>";
        });
        
        /*
         * Generic if closer to not interfere with built in blade
         */
        Blade::directive('endauth', function () {
            return '<?php endif; ?>';
        });

        /*
         * Register Breadcrumbs component
         */
        Blade::component('layouts.admin.includes.breadcrumbs', 'breadcrumbs');
    }

}
