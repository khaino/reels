<?php

namespace App\Providers;

use App\Repositories\Videos\VideoRepository;
use App\Repositories\Videos\VideoRepositoryImpl;
use Illuminate\Support\ServiceProvider;
use App\Services\VideoClipServiceImpl;
use App\Repositories\VideoClipRepositoryImpl;

class VideoClipServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(\App\Services\VideoClipService::class, function ($app) {
            return new VideoClipServiceImpl($app->make(VideoClipRepositoryImpl::class));
        });
    }
}
