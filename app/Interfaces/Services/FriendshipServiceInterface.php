<?php
namespace App\Interfaces\Services;

use Illuminate\Pagination\LengthAwarePaginator;

interface FriendshipServiceInterface
{
    /**
     * Paginate models.
     *
     * @return LengthAwarePaginator
     */
    public function index(): LengthAwarePaginator;
}
