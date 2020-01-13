<?php
namespace App\Interfaces;

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
     * @param string $id
     * @return Task
     */
    public function show(string $id): Task;

    /**
     * Utilize repository to create a model.
     *
     * @param array|null $attributes
     * @return Task
     */
    public function create(?array $attributes = []): Task;

    /**
     * Update a model.
     *
     * @param string $id
     * @param array|null $attributes
     * @return Task
     */
    public function update(string $id, ?array $attributes = []): Task;

    /**
     * Flag a task to mark as important.
     *
     * @param string $task
     * @param string $assignee
     * @return Task
     */
    public function complete(string $task, string $assignee): Task;

    /**
     * Remove the flag of a task to mark as important.
     *
     * @param string $task
     * @return Task
     */
    public function incomplete(string $task): Task;

    /**
     * Delete a model.
     *
     * @param string $id
     * @return Task
     */
    public function delete(string $id): Task;
}
