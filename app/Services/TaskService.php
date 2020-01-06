<?php

namespace App\Services;

use App\Models\Task;
use App\Repositories\TaskRepository;

class TaskService extends BaseService
{
    /**
     * @var AssigneeService $assigneeService
     */
    public $assigneeService;

    /**
     * Validation base rules.
     *
     * @var array $rules
     */
    protected $rules = [
        'name' => 'sometimes|required|min:6|max:255',
        'body' => 'sometimes|required',
        'flagged' => 'sometimes|boolean',
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
     * @param AssigneeService $assigneeService
     */
    public function __construct(TaskRepository $repository, AssigneeService $assigneeService)
    {
        $this->repository = $repository;
        $this->assigneeService = $assigneeService;
    }

    /**
     * @inheritDoc
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
     * Assign a model.
     *
     * @param string $task
     * @param string $user
     * @return mixed
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function assign(string $task, string $user)
    {
        return $this->assigneeService->assign($task, $user);
    }

    /**
     * Unassign a model.
     *
     * @param string $task
     * @param string $user
     * @return mixed
     */
    public function unassign(string $task, string $user)
    {
        /**
         * @var Task $task
         */
        $task = $this->repository()->find($task);
        return $task->assignees()->where([
            'user_id' => $user,
        ])->delete();
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
