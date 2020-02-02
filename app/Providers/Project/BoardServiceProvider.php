<?php

namespace App\Providers\Project;

use App\Repositories\BoardRepository;
use App\Services\BoardService;
use Illuminate\Support\ServiceProvider;

class BoardServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Interfaces\Services\BoardServiceInterface', function ($app) {
            return new BoardService(
                $app->make(BoardRepository::class)
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
