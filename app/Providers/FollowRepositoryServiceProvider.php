<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\FollowRepositoryInterface;
use App\Repositories\FollowRepository;

class FollowRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(FollowRepositoryInterface::class, FollowRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
