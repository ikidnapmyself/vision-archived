<?php
namespace App\Repositories;

class ProjectRepository extends Repository {

    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return "App\\Models\\Project";
    }
}
