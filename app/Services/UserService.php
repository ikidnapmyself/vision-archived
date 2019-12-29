<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService extends BaseService
{
    /**
     * Validation base rules.
     *
     * @var array $rules
     */
    protected $rules = [
        //
    ];

    /**
     * UserService constructor.
     *
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function index()
    {
        return $this->repository->with('friends')->paginate();
    }

    /**
     * @inheritDoc
     */
    public function show(string $id)
    {
        return $this->repository->with('friends')->find($id);
    }
}
