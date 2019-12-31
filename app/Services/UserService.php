<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService extends BaseService
{
    /**
     * Validation base rules.
     *
     * @var array
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
     * {@inheritdoc}
     */
    public function index()
    {
        return $this->repository->with('friends')->paginate();
    }

    /**
     * {@inheritdoc}
     */
    public function show(string $id)
    {
        return $this->repository->with('friends')->find($id);
    }
}
