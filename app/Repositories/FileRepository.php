<?php

namespace App\Repositories;

class FileRepository extends Repository
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return 'App\\Models\\File';
    }
}
