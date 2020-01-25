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
     * Socialite based login.
     *
     * @param SocialiteUser $user
     * @return User
     */
    public function login(SocialiteUser $user): User;

    /**
     * Update a model.
     *
     * @param string $id
     * @return User
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(string $id): User;
}
