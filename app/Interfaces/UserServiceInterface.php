<?php
namespace App\Interfaces;

use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
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
     * @param SocialiteUser $user
     * @param string $provider
     * @return User
     */
    public function integrate(SocialiteUser $user, string $provider): User;

    /**
     * Update a model.
     *
     * @param string $id
     * @return User
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(string $id): User;
}
