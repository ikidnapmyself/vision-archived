<?php

namespace App\Providers\Project;

use App\Models\Assignee;
use App\Repositories\AssigneeRepository;
use App\Services\AssigneeService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

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
                $app->make(AssigneeRepository::class)
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
        Validator::extend('assigned', function ($attribute, $value, $parameters, $validator) {
            $count = Assignee::where(function ($q) use ($validator, $parameters) {
                $where  = [];

                foreach ($parameters as $parameter) {
                    $where[$parameter] = $validator->getData()[$parameter] ?? false;
                }

                $q->where($where);
            })->count();

            return !$count;
        });
    }
}
