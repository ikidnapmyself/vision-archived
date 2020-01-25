<?php
namespace App\Repositories;

use App\Models\Integration;

class IntegrationRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Integration::class;
    }
}
