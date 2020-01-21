<?php
namespace App\Interfaces;

use App\Http\Requests\AssigneeCreateRequest;
use App\Http\Requests\AssigneeUpdateRequest;
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
     * @param AssigneeCreateRequest $request
     * @return Assignee
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(AssigneeCreateRequest $request): Assignee;

    /**
     * Update a model.
     *
     * @param AssigneeUpdateRequest $request
     * @param string $id
     * @return Assignee
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(AssigneeUpdateRequest $request, string $id): Assignee;

    /**
     * Unassign a model.
     *
     * @param string $id
     * @return Assignee
     */
    public function delete(string $id): Assignee;

    /**
     * Set completed at field.
     *
     * @param string $assignee
     * @return bool
     */
    public function complete(string $assignee): bool;

    /**
     * Set completed at field null.
     *
     * @param string $assignee
     * @return bool
     */
    public function incomplete(string $assignee): bool;
}
