<?php

namespace App\Repositories;

use App\Models\Definition;

class DefinitionRepository extends Repository
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Definition::class;
    }
}
