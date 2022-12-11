<?php

namespace App\Interfaces\Services;

use App\Http\Requests\TaskRequest;
use App\Http\Requests\TaskStatusRequest;
use App\Models\Task;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface TaskServiceInterface
{
    /**
     * Paginate models.
     *
     * @return LengthAwarePaginator
     */
    public function index(): LengthAwarePaginator;

    /**
     * Display model.
     *
     * @param  string  $id
     * @return Task
     */
    public function show(string $id): Task;

    /**
     * Utilize repository to create a model.
     *
     * @param  TaskRequest  $taskRequest,
     * @return Task
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(TaskRequest $taskRequest): Task;

    /**
     * Update a model.
     *
     * @param  TaskRequest  $taskRequest
     * @param  string  $id
     * @return Task
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(TaskRequest $taskRequest, string $id): Task;

    /**
     * Delete a model.
     *
     * @param  string  $id
     * @return Task
     */
    public function delete(string $id): Task;

    /**
     * Set status of a model.
     *
     * @param  TaskStatusRequest  $request
     * @param  string  $id
     * @return Task
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function status(TaskStatusRequest $request, string $id): Task;
}
