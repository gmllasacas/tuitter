<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\TweetRepositoryInterface;
use App\Repositories\TweetRepository;

class TweetRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TweetRepositoryInterface::class, TweetRepository::class);
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
