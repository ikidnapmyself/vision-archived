<?php
namespace App\Repositories;

use App\Models\Project;

class ProjectRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Project::class;
    }
}
