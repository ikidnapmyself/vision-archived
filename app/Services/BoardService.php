<?php

namespace App\Services;

use App\Interfaces\Services\BoardServiceInterface;
use App\Models\Board;
use App\Repositories\BoardRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BoardService implements BoardServiceInterface
{
    /**
     * @var BoardRepository
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
     * {@inheritdoc}
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
     * {@inheritdoc}
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
