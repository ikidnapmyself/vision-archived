<?php
namespace App\Repositories;

class TeamRepository extends Repository {

    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return "App\\Models\\Team";
    }
}
