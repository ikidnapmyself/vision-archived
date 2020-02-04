<?php

namespace App\Services;

use App\Interfaces\Services\FriendshipServiceInterface;
use App\Interfaces\Services\UserServiceInterface;
use App\Repositories\FriendshipRepository;
use Illuminate\Pagination\LengthAwarePaginator;

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
     * @param FriendshipRepository $repository
     * @param UserServiceInterface $userService
     */
    public function __construct(FriendshipRepository $repository, UserServiceInterface $userService)
    {
        $this->repository = $repository;
        $this->userService = $userService;
    }

    /**
     * {@inheritdoc}
     */
    public function index(): LengthAwarePaginator
    {
        $id = \Auth::user()->id;

        return $this->userService->friends($id);
    }
}
