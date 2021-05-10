<?php

namespace App\Services;

use App\Interfaces\Services\BoardServiceInterface;
use App\Models\Board;
use App\Repositories\BoardRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

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
     * @inheritDoc
     */
    public function index(Model $model): Collection
    {
        return $this->repository
            ->findWhere([
                'morph_type' => get_class($model),
                'morph_id'   => $model->id,
            ]);
    }

    /**
     * @inheritDoc
     */
    public function show(string $id): Board
    {
        /**
         * @var Board $retrieve
         */
        $retrieve = $this->repository
            ->with([
                'morph',
                'tasks.createdBy',
            ])
            ->find($id);

        $grouped = $retrieve->tasks->groupBy('current_status.name');
        $retrieve->setAttribute('tasks', $grouped);

        return $retrieve;
    }
}
