<?php
namespace App\Repositories;

use App\Models\File;

class FileRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return File::class;
    }
}
