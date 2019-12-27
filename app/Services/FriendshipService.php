<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\FriendshipRepository;

class FriendshipService extends BaseService
{
    /**
     * Validation base rules.
     *
     * @var array
     */
    protected $rules = [
        'body' => 'BREAK',
    ];

    /**
     * @var UserService
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
        $this->repository = $repository;
        $this->userService = $userService;
    }

    /**
     * {@inheritdoc}
     */
    public function show(string $id)
    {
        /**
         * @var User
         */
        $user = $this->userService->repository()->find($id);

        return $user->getFriends();
    }
}
