<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Reels\CreateReelService;
use App\Services\Reels\CreateReelServiceImpl;
use App\Repositories\Videos\VideoRepository;
use App\Repositories\ReelRepositoryImpl;
use App\Repositories\Videos\VideoRepositoryImpl;

class ReelRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ReelRepository::class, function ($app) {
            return new ReelRepositoryImpl($app->make(VideoClipRepositoryImpl::class));
        });
    }
}
