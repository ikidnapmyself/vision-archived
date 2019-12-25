<?php

namespace App\Services;

use App\Interfaces\ServiceInterface;
use App\Repositories\VisionRepository;

class VisionService extends BaseService implements ServiceInterface
{
    /**
     * TaskService constructor.
     *
     * @param VisionRepository $repository
     */
    public function __construct(VisionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * System defaults.
     *
     * @return mixed
     */
    public function defaults()
    {
        return $this->repository->findByField('created_by', null)->all();
    }

    /**
     * {@inheritdoc}
     */
    public function show(string $id)
    {
        return $this->repository()->find($id)->load('assignees.user');
    }
}
