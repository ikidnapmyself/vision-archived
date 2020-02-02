<?php

namespace App\Providers\Project;

use App\Repositories\IntegrationRepository;
use App\Services\IntegrationService;
use Illuminate\Support\ServiceProvider;

class IntegrationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Interfaces\Services\IntegrationServiceInterface', function ($app) {
            return new IntegrationService(
                $app->make(IntegrationRepository::class)
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
