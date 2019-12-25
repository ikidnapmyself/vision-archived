<?php

namespace App\Repositories;

use App\Models\Vision;

class VisionRepository extends Repository
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Vision::class;
    }
}
