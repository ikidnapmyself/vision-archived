<?php
namespace App\Repositories;

use App\Models\Team;

class TeamRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Team::class;
    }
}
