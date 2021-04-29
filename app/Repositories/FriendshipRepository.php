<?php

namespace App\Repositories;

use App\Models\Friendship;

class FriendshipRepository extends Repository
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Friendship::class;
    }

    /**
     * @inheritDoc
     */
    public function index()
    {
        return $this->repository->paginate();
    }
}
