<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\FriendshipRepository;

class FriendshipService extends BaseService
{
    /**
     * Validation base rules.
     *
     * @var array $rules
     */
    protected $rules = [
        'body' => 'BREAK',
    ];

    /**
     * @var UserService $userService
     */
    protected $userService;

    /**
     * FriendshipService constructor.
     *
     * @param FriendshipRepository $repository
     * @param UserService $userService
     */
    public function __construct(FriendshipRepository $repository, UserService $userService)
    {
        $this->repository  = $repository;
        $this->userService = $userService;
    }

    /**
     * @inheritDoc
     */
    public function show(string $id)
    {
        /**
         * @var User $user
         */
        $user   = $this->userService->repository->find($id);
        $models = $user->getFriends();

        return $models;
    }
}
