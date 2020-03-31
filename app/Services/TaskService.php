<?php

namespace App\Services;

use App\Http\Requests\TaskRequest;
use App\Http\Requests\TaskStatusRequest;
use App\Interfaces\Services\AssigneeServiceInterface;
use App\Interfaces\Services\TaskServiceInterface;
use App\Models\Status;
use App\Models\Task;
use App\Repositories\TaskRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;

class TaskService implements TaskServiceInterface
{
    /**
     * @var TaskRepository
     */
    public $repository;

    /**
     * @var AssigneeServiceInterface
     */
    public $assigneeService;

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
     * @param AssigneeServiceInterface $assigneeService
     */
    public function __construct(TaskRepository $repository, AssigneeServiceInterface $assigneeService)
    {
        $this->repository = $repository;
        $this->assigneeService = $assigneeService;
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
     * @throws \Spatie\ModelStatus\Exceptions\InvalidStatus
     */
    public function status(TaskStatusRequest $status, string $id): Task
    {
        $valid = $status->validated();
        /**
         * @var Task $task
         */
        $task = $this->repository->find($id);
        $assignee = Arr::get($valid, 'assignee', false);
        $relation = null;

        if (Status::COMPLETED === Arr::get($valid, 'status')) {
            $complete = $task->fill(['completed_by' => $assignee])->save();
            if (true === $complete) {
                $relation = $this->assigneeService->show($assignee);
                $assignee = $this->assigneeService->complete($assignee);
            }
        } elseif (Status::COMPLETED === $task->status) {
            $complete = $task->fill(['completed_by' => null])->save();
            if (true === $complete) {
                $relation = $this->assigneeService->show($assignee);
                $assignee = $this->assigneeService->incomplete($assignee);
            }
        }

        if ($assignee) {
            $task->setRelation('completedBy', $relation);
        }

        return $task->setStatus($valid['status'], $valid['reason']);
    }
}
