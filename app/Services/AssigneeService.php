<?php

namespace App\Services;

use App\Repositories\AssigneeRepository;

class AssigneeService extends BaseService
{
    /**
     * Validation base rules.
     *
     * @todo improve
     * @var array
     */
    protected $rules = [
        'due'            => 'sometimes|nullable|date_format:Y-m-d H:i:s',
        'defer'          => 'sometimes|nullable|date_format:Y-m-d H:i:s',
        'difficulty'     => 'sometimes|nullable|digits_between:-10,10',
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
     */
    public function __construct(AssigneeRepository $repository)
    {
        $this->repository = $repository;
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
        return $this->repository->create([
            'task_id' => $task,
            'user_id' => $user,
        ]);
    }
}
