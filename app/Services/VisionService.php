<?php

namespace App\Services;

use App\Repositories\VisionRepository;

class VisionService implements ServiceInterface
{
    /**
     * @var VisionRepository
     */
    private $repository;

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
     * Get repository.
     *
     * @return VisionRepository
     */
    public function repository()
    {
        return $this->repository;
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
     * List all the resources.
     *
     * @return mixed
     */
    public function index()
    {
        return $this->repository->paginate();
    }

    /**
     * Display model.
     *
     * @param string $id
     * @return mixed
     */
    public function show(string $id)
    {
        return $this->repository()->find($id)->load('assignees.user');
    }

    public function create()
    {
        // TODO: fill this method
    }

    public function update()
    {
        // TODO: fill this method
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }
}
