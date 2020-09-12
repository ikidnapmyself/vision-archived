<?php

namespace App\Interfaces\Services;

use Illuminate\Support\Collection;

interface FriendshipServiceInterface
{
    /**
     * Friend list.
     *
     * @param string $id
     * @return Collection
     * @throws \Illuminate\Validation\ValidationException
     */
    public function friends(string $id): Collection;

    /**
     * Pending friends of a model.
     *
     * @param string $id
     * @return Collection
     * @throws \Illuminate\Validation\ValidationException
     */
    public function pending(string $id): Collection;

    /**
     * Blocked list of a model.
     *
     * @param string $id
     * @return Collection
     * @throws \Illuminate\Validation\ValidationException
     */
    public function blocked(string $id): Collection;
}
