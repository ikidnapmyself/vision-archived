<?php

namespace App\Providers\Project;

use App\Interfaces\IntegrationServiceInterface;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Interfaces\UserServiceInterface', function ($app) {
            return new UserService(
                $app->make(UserRepository::class),
                $app->make(IntegrationServiceInterface::class)
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
