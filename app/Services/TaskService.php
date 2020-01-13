<?php

namespace App\Services;

use App\Http\Requests\TaskRequest;
use App\Interfaces\TaskServiceInterface;
use App\Models\Task;
use App\Repositories\TaskRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TaskService implements TaskServiceInterface
{
    /**
     * @var TaskRepository $repository
     */
    public $repository;

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
     * @inheritDoc
     */
    public function index(): LengthAwarePaginator
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
    public function show(string $id): Task
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
        return $this->repository->find($id)->setStatus($name, $reason);
    }

    /**
     * Set flag of a model.
     *
     * @param string $id
     * @return mixed
     */
    public function flag(string $id)
    {
        $task = $this->repository->find($id);
        $task->flagged = ! $task->flagged;
        $task->save();
        return $task;
    }

    /**
     * Utilize repository to create a model.
     *
     * @param TaskRequest $taskRequest
     * @param array|null $attributes
     * @return mixed
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function create(TaskRequest $taskRequest, ?array $attributes = []): Task
    {
        $validated = $taskRequest->validated();

        $attributes = array_merge($attributes, $validated);

        return $this->repository->create($attributes);
    }

    /**
     * Update a model.
     *
     * @param TaskRequest $taskRequest
     * @param string $id
     * @param array|null $attributes
     * @return Task
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(TaskRequest $taskRequest, string $id, ?array $attributes = []): Task
    {
        $validated = $taskRequest->validated();

        $attributes = array_merge($attributes, $validated);

        return $this->repository->update($attributes, $id);
    }

    /**
     * Delete a model.
     *
     * @param string $id
     * @return mixed
     */
    public function delete(string $id): Task
    {
        // TODO: Implement delete() method.
    }

    /**
     * Flag a task to mark as important.
     *
     * @param string $task
     * @param string $assignee
     * @return Task
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function complete(string $task, string $assignee): Task
    {
        $complete = $this->repository->update([
            'completed_by' => $assignee
        ], $task);

        /**
         * @todo 'completed' must be const.
         */
        $complete->setStatus('completed', 'No reason yet.');

        return $complete;
    }

    /**
     * Remove the flag of a task to mark as important.
     *
     * @param string $task
     * @return Task
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function incomplete(string $task): Task
    {
        $complete = $this->repository->update([
            'completed_by' => null
        ], $task);

        dd($complete->status());

        $complete->setStatus('completed', 'No reason yet.');

        return $complete;
    }
}
