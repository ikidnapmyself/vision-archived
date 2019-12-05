<?php

namespace App\Repositories;

class AssigneeRepository extends Repository
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return 'App\\Models\\Assignee';
    }
}
