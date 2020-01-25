<?php

namespace App\Services;

use App\Http\Requests\AssigneeCreateRequest;
use App\Http\Requests\AssigneeUpdateRequest;
use App\Interfaces\AssigneeServiceInterface;
use App\Models\Assignee;
use App\Repositories\AssigneeRepository;
use Illuminate\Support\Carbon;
use Prettus\Validator\Exceptions\ValidatorException;

class AssigneeService implements AssigneeServiceInterface
{
    /**
     * @var AssigneeRepository
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
     * AssigneeService constructor.
     *
     * @param AssigneeRepository $repository
     */
    public function __construct(AssigneeRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * {@inheritdoc}
     */
    public function show(string $id): Assignee
    {
        return $this->repository->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function create(AssigneeCreateRequest $request): Assignee
    {
        $validated = $request->validated();

        return $this->repository->create($validated);
    }

    /**
     * {@inheritdoc}
     */
    public function update(AssigneeUpdateRequest $request, string $id): Assignee
    {
        $validated = $request->validated();

        return $this->repository->update($validated, $id);
    }

    /**
     * {@inheritdoc}
     */
    public function delete(string $id): Assignee
    {
        $model = $this->repository->find($id);
        $model->delete($id);

        return $model;
    }

    /**
     * {@inheritdoc}
     */
    public function complete(string $assignee): bool
    {
        try {
            $update = $this->repository->update(['completed_at' => Carbon::now()], $assignee);

            return is_a($update, 'App\Models\Assignee');
        } catch (ValidatorException $e) {
            report($e);

            return false;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function incomplete(string $assignee): bool
    {
        try {
            $update = $this->repository->update(['completed_at' => null], $assignee);

            return is_a($update, 'App\Models\Assignee');
        } catch (ValidatorException $e) {
            report($e);

            return false;
        }
    }
}
