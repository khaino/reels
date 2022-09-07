<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;

class VideoRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(\App\Repositories\VideoClipRepository::class, function ($app) {
            return new \App\Repositories\VideoClipRepositoryImpl;
        });
    }
}
