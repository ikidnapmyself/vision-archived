<?php

namespace App\Interfaces\Services;

//use App\Http\Requests\BoardCreateRequest;
//use App\Http\Requests\BoardUpdateRequest;
use App\Models\Board;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface BoardServiceInterface
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
     * @return Board
     */
    public function show(string $id): Board;

    /**
     * Assign a model.
     *
     * @param BoardCreateRequest $request
     * @return Board
     * @throws \Illuminate\Validation\ValidationException
     */
//    public function create(BoardCreateRequest $request): Board;

    /**
     * Update a model.
     *
     * @param BoardUpdateRequest $request
     * @param string $id
     * @return Board
     * @throws \Illuminate\Validation\ValidationException
     */
//    public function update(BoardUpdateRequest $request, string $id): Board;

    /**
     * Unassign a model.
     *
     * @param string $id
     * @return Board
     */
//    public function delete(string $id): Board;
}
