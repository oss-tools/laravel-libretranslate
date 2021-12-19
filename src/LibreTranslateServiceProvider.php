<?php

namespace OSSTools\LibreTranslate;

use Illuminate\Support\ServiceProvider;

class LibreTranslateServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/laravel-libretranslate.php' => config_path('laravel-libretranslate.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/laravel-libretranslate.php', 'laravel-libretranslate');
    }
}
