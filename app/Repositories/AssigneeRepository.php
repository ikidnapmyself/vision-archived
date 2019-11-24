<?php
namespace App\Repositories;

class AssigneeRepository extends Repository {

    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return "App\\Models\\Assignee";
    }
}
