<?php
namespace App\Interfaces\Services;

use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Laravel\Socialite\Contracts\User as SocialiteUser;

interface UserServiceInterface
{
    /**
     * Paginate models.
     *
     * @return LengthAwarePaginator
     */
    public function index(): LengthAwarePaginator;

    /**
     * Display model.
     *
     * @param string $id
     * @return User
     */
    public function show(string $id): User;

    /**
     * Utilize repository to create a model.
     *
     * @param UserCreateRequest $request
     * @return User
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(UserCreateRequest $request): User;

    /**
     * Create a model to integrate a service.
     *
     * @param SocialiteUser $socialiteUser
     * @param string $provider
     * @param null|User $user
     * @return User
     */
    public function integrate(SocialiteUser $socialiteUser, string $provider, ?User $user = null): User;

    /**
     * Create a model to integrate a service.
     *
     * @param string $user
     * @return Collection
     */
    public function integrations(string $user): Collection;

    /**
     * Update a model.
     *
     * @param string $id
     * @return User
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(string $id): User;

    /**
     * Friends of an user.
     *
     * @param string $id
     * @return Collection
     * @throws \Illuminate\Validation\ValidationException
     */
    public function acceptedFriendships(string $id): Collection;

    /**
     * Pending friendships of an user.
     *
     * @param string $id
     * @return Collection
     * @throws \Illuminate\Validation\ValidationException
     */
    public function pendingFriendships(string $id): Collection;
    /**
     * Blocked friends of an user.
     *
     * @param string $id
     * @return Collection
     * @throws \Illuminate\Validation\ValidationException
     */
    public function blockedFriendships(string $id): Collection;

}
