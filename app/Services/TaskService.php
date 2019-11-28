<?php

namespace App\Services;

use App\Repositories\TaskRepository;

class TaskService implements ServiceInterface
{
    /**
     * @var TaskRepository
     */
    private $repository;

    /**
     * TaskService constructor.
     *
     * @param TaskRepository $repository
     */
    public function __construct(TaskRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get repository.
     *
     * @return TaskRepository
     */
    public function repository()
    {
        return $this->repository;
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
        // TODO: Implement.
    }

    public function update()
    {
        // TODO: Implement.
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }
}
