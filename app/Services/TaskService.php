<?php

namespace App\Services;

use App\Http\Requests\TaskRequest;
use App\Http\Requests\TaskStatusRequest;
use App\Interfaces\TaskServiceInterface;
use App\Models\Task;
use App\Repositories\TaskRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TaskService implements TaskServiceInterface
{
    /**
     * @var TaskRepository
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
     * {@inheritdoc}
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
     * {@inheritdoc}
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
     * {@inheritdoc}
     */
    public function create(TaskRequest $taskRequest): Task
    {
        $validated = $taskRequest->validated();

        return $this->repository->create($validated);
    }

    /**
     * {@inheritdoc}
     */
    public function update(TaskRequest $taskRequest, string $id): Task
    {
        $validated = $taskRequest->validated();

        return $this->repository->update($validated, $id);
    }

    /**
     * {@inheritdoc}
     */
    public function delete(string $id): Task
    {
        $model = $this->repository->find($id);
        $model->delete($id);

        return $model;
    }

    /**
     * {@inheritdoc}
     */
    public function status(TaskStatusRequest $status, string $id): Task
    {
        $valid = $status->validated();

        return $this->repository->find($id)->setStatus($valid['status'], $valid['reason']);
    }
}
