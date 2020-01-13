<?php

namespace App\Services;

use App\Interfaces\AssigneeServiceInterface;
use App\Interfaces\TaskServiceInterface;
use App\Models\Assignee;
use App\Repositories\AssigneeRepository;
use Carbon\Carbon;

class AssigneeService implements AssigneeServiceInterface
{
    /**
     * @var AssigneeRepository $repository
     */
    public $repository;

    /**
     * @var TaskServiceInterface $taskService
     */
    public $taskService;

    /**
     * Validation base rules.
     *
     * @var array $rules
     */
    protected $rules = [
        'due'            => 'sometimes|nullable|date_format:Y-m-d H:i:s',
        'defer'          => 'sometimes|nullable|date_format:Y-m-d H:i:s',
        'difficulty'     => 'sometimes|nullable|between:-10,10',
        'estimated_time' => 'sometimes|nullable|integer',
        'blocker'        => 'boolean',
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
     * AssigneeService constructor.
     *
     * @param AssigneeRepository $repository
     * @param TaskServiceInterface $taskService
     */
    public function __construct(AssigneeRepository $repository, TaskServiceInterface $taskService)
    {
        $this->repository = $repository;
        $this->taskService = $taskService;
    }

    /**
     * Display model.
     *
     * @param string $id
     * @return Assignee
     */
    public function show(string $id): Assignee
    {
        return $this->repository->find($id);
    }

    /**
     * Utilize repository to create a model.
     *
     * @param array|null $attributes
     * @return Assignee
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function create(?array $attributes = []): Assignee
    {
        return $this->repository->create(\Request::all());
    }

    /**
     * Update a model.
     *
     * @param string $id
     * @param array|null $attributes
     * @return mixed
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(string $id, ?array $attributes = []): Assignee
    {
        return $this->repository->update(\Request::all(), $id);
    }

    /**
     * Delete a model.
     *
     * @param string $id
     * @return mixed
     */
    public function delete(string $id): Assignee
    {
        $model = $this->repository->find($id);
        $model->delete($id);

        return $model;
    }

    /**
     * Complete a task.
     *
     * @param string $assignee
     * @return mixed
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function complete(string $assignee): Assignee
    {
        $complete = $this->repository->update([
            'completed_at' => Carbon::now()
        ], $assignee);

        $task = $this->taskService->complete($complete->task_id, $complete->id);

        $complete->setRelation('task', $task);

        return $complete;
    }

    /**
     * Incomplete a task.
     *
     * @param string $assignee
     * @return Assignee
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function incomplete(string $assignee): Assignee
    {
        $incomplete = $this->repository->update([
            'completed_at' => null
        ], $assignee);

        $task = $this->taskService->incomplete($incomplete->task_id);

        $incomplete->setRelation('task', $task);

        return $incomplete;
    }
}
