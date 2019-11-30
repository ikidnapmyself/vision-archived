<?php

namespace App\Repositories;

class TaskRepository extends Repository
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return 'App\\Models\\Task';
    }
}
