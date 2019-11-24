<?php
namespace App\Repositories;

class VariableRepository extends Repository {

    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return "App\\Models\\Variable";
    }
}
