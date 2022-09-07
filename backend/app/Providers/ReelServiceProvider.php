<?php

namespace App\Providers;

use App\Repositories\ReelRepositoryImpl;
use App\Services\ReelService;
use App\Services\ReelServiceImpl;
use Illuminate\Support\ServiceProvider;

class ReelServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ReelService::class, function ($app) {
            return new ReelServiceImpl($app->make(ReelRepositoryImpl::class));
        });
    }
}
