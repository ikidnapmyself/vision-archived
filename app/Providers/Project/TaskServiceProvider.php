<?php

namespace App\Providers\Project;

use App\Interfaces\AssigneeServiceInterface;
use App\Repositories\TaskRepository;
use App\Services\TaskService;
use Illuminate\Support\ServiceProvider;

class TaskServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Interfaces\TaskServiceInterface', function ($app) {
            return new TaskService(
                $app->make(TaskRepository::class),
                $app->make(AssigneeServiceInterface::class)
            );
        });
    }

    /**
     * @return void
     */
    public function boot()
    {
        //
    }
}
