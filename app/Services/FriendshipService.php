<?php

namespace App\Services;

use App\Interfaces\Services\FriendshipServiceInterface;
use App\Interfaces\Services\UserServiceInterface;
use App\Repositories\FriendshipRepository;
use Illuminate\Support\Collection;

class FriendshipService implements FriendshipServiceInterface
{
    /**
     * @var FriendshipRepository
     */
    public $repository;

    /**
     * @var UserServiceInterface
     */
    protected $userService;

    /**
     * FriendshipService constructor.
     *
     * @param  FriendshipRepository  $repository
     * @param  UserServiceInterface  $userService
     */
    public function __construct(FriendshipRepository $repository, UserServiceInterface $userService)
    {
        $this->repository = $repository;
        $this->userService = $userService;
    }

    /**
     * @inheritDoc
     */
    public function friends(string $id): Collection
    {
        return $this->userService->acceptedFriendships($id);
    }

    /**
     * @inheritDoc
     */
    public function pending(string $id): Collection
    {
        return $this->userService->pendingFriendships($id);
    }

    /**
     * @inheritDoc
     */
    public function blocked(string $id): Collection
    {
        return $this->userService->blockedFriendships($id);
    }
}
