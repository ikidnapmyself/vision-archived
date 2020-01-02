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
     * {@inheritdoc}
     */
    public function index()
    {
        return $this->repository
            ->with([
                'assignees.user',
                'createdBy',
            ])
            ->paginate();
    }

    /**
     * Display model.
     *
     * @param string $id
     * @return mixed
     */
    public function show(string $id)
    {
        return $this->repository
            ->with([
                'assignees.user',
                'createdBy',
            ])
            ->find($id);
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
}
