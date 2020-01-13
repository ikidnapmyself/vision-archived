<?php

namespace App\Providers;

use App\Interfaces\TaskServiceInterface;
use App\Repositories\AssigneeRepository;
use App\Services\AssigneeService;
use Illuminate\Support\ServiceProvider;

class AssigneeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Interfaces\AssigneeServiceInterface', function ($app) {
            return new AssigneeService(
                $app->make(AssigneeRepository::class),
                $app->make(TaskServiceInterface::class)
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
