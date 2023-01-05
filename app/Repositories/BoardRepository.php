<?php

namespace App\Repositories;

use App\Models\Board;

class BoardRepository extends Repository
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Board::class;
    }
}
