<?php

namespace App\Services;

use App\Repositories\TaskRepository;

class TaskService extends BaseService
{
    /**
     * Validation base rules.
     *
     * @var array
     */
    protected $rules = [
        'name' => 'required|min:6|max:255',
        'body' => 'sometimes',
    ];

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
     * Display model.
     *
     * @param string $id
     * @return mixed
     */
    public function show(string $id)
    {
        return $this->repository()->find($id)->load('assignees.user');
    }
}
