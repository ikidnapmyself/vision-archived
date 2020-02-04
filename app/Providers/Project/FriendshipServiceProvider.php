<?php

namespace App\Providers\Project;

use App\Interfaces\Services\UserServiceInterface;
use App\Repositories\FriendshipRepository;
use App\Services\FriendshipService;
use Illuminate\Support\ServiceProvider;

class FriendshipServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Interfaces\Services\FriendshipServiceInterface', function ($app) {
            return new FriendshipService(
                $app->make(FriendshipRepository::class),
                $app->make(UserServiceInterface::class)
            );
        });
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
