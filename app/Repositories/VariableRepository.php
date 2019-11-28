<?php

namespace App\Repositories;

class VariableRepository extends Repository
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return 'App\\Models\\Variable';
    }
}
