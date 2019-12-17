<?php
namespace App\Repositories;

use App\Models\Variable;

class VariableRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Variable::class;
    }
}
