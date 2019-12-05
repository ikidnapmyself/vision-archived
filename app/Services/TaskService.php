<?php

namespace App\Services;

use App\Repositories\TaskRepository;

class TaskService extends BaseService
{
    /**
     * Validation base rules.
     *
     * @var array $rules
     */
    protected $rules = [
        'name' => 'required|min:6|max:255',
        'body' => 'sometimes',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'current_status',
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

    /**
     * Set status of a model.
     *
     * @param string $id
     * @param string $name
     * @param string|null $reason
     * @return mixed
     */
    public function status(string $id, string $name, ?string $reason = null)
    {
        return $this->repository()->find($id)->setStatus($name, $reason);
    }

    /**
     * Set flag of a model.
     *
     * @param string $id
     * @return mixed
     */
    public function flag(string $id)
    {
        $task = $this->repository()->find($id);
        $task->flagged = ! $task->flagged;
        $task->save();
        return $task;
    }

    /**
     * Set star of a model.
     *
     * @param string $id
     * @return mixed
     */
    public function star(string $id)
    {
        $task = $this->repository()->find($id);
        $task->starred = ! $task->starred;
        $task->save();
        return $task;
    }
}
