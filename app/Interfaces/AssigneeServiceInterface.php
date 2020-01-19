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
     */
    public function create(AssigneeCreateRequest $request): Assignee;

    /**
     * Update a model.
     *
     * @param AssigneeUpdateRequest $request
     * @param string $id
     * @return Assignee
     */
    public function update(AssigneeUpdateRequest $request, string $id): Assignee;

    /**
     * Unassign a model.
     *
     * @param string $id
     * @return Assignee
     */
    public function delete(string $id): Assignee;
}
