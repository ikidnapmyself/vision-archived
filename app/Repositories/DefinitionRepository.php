<?php
namespace App\Repositories;

class DefinitionRepository extends Repository {

    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return "App\\Models\\Definition";
    }
}
