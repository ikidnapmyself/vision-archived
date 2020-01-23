<?php

namespace App\Services;

use App\Interfaces\BoardServiceInterface;
use App\Models\Board;
use App\Repositories\BoardRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BoardService implements BoardServiceInterface
{
    /**
     * @var BoardRepository $repository
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
     * BoardService constructor.
     *
     * @param BoardRepository $repository
     */
    public function __construct(BoardRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function index(): LengthAwarePaginator
    {
        return $this->repository
//            ->with([
//                'assignees.user',
//                'createdBy',
//            ])
            ->paginate();
    }

    /**
     * @inheritDoc
     */
    public function show(string $id): Board
    {
        return $this->repository
//            ->with([
//                'assignees.user',
//                'createdBy',
//            ])
            ->find($id);
    }
}
