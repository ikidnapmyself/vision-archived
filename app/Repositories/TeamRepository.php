<?php

namespace App\Repositories;

class TeamRepository extends Repository
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return 'App\\Models\\Team';
    }
}
