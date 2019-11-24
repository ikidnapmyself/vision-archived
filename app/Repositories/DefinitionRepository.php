<?php

namespace App\Repositories;

class DefinitionRepository extends Repository
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return 'App\\Models\\Definition';
    }
}
