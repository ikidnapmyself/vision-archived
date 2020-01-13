<?php
namespace App\Interfaces;

use App\Models\Assignee;

interface AssigneeServiceInterface
{
    /**
     * Display model.
     *
     * @param string $id
     * @return Assignee
     */
    public function show(string $id): Assignee;

    /**
     * Assign a model.
     *
     * @param array|null $attributes
     * @return Assignee
     */
    public function create(?array $attributes = []): Assignee;

    /**
     * Update a model.
     *
     * @param string $id
     * @param array|null $attributes
     * @return Assignee
     */
    public function update(string $id, ?array $attributes = []): Assignee;

    /**
     * Complete a task.
     *
     * @param string $assignee
     * @return Assignee
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function complete(string $assignee): Assignee;

    /**
     * Incomplete a task.
     *
     * @param string $assignee
     * @return Assignee
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function incomplete(string $assignee): Assignee;

    /**
     * Unassign a model.
     *
     * @param string $id
     * @return Assignee
     */
    public function delete(string $id): Assignee;
}
