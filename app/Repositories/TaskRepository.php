<?php
namespace App\Repositories;

use App\Models\Task;

class TaskRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Task::class;
    }
}
