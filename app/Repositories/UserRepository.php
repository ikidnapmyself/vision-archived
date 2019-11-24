<?php

namespace App\Repositories;

class UserRepository extends Repository
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return 'App\\Models\\User';
    }
}
