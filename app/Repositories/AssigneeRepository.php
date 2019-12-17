<?php
namespace App\Repositories;

use App\Models\Assignee;

class AssigneeRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Assignee::class;
    }
}
