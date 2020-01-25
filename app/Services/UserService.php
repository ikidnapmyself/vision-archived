<?php

namespace App\Services;

use App\Http\Requests\UserCreateRequest;
use App\Interfaces\UserServiceInterface;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Laravel\Socialite\Contracts\User as SocialiteUser;

class UserService implements UserServiceInterface
{
    /**
     * @var UserRepository $repository
     */
    public $repository;

    /**
     * UserService constructor.
     *
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function index(): LengthAwarePaginator
    {
        return $this->repository->with('friends')->paginate();
    }

    /**
     * @inheritDoc
     */
    public function show(string $id): User
    {
        return $this->repository->with('friends')->find($id);
    }

    /**
     * Utilize repository to create a model.
     *
     * @param UserCreateRequest $request
     * @return User
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(UserCreateRequest $request): User
    {
        // TODO: Implement create() method.
    }

    /**
     * Socialite based login.
     *
     * @param SocialiteUser $user
     * @return User
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function login(SocialiteUser $user): User
    {
        $find = $this->repository->findByField('email', $user->getEmail())->first();

        if ($find !== null) {
            \Auth::login($find, true);

            return $find;
        } else {
            $username = collect(
                explode(' ', $user->getName())
            );

            $create = $this->repository->create([
                'name'    => $username->first(),
                'surname' => $username->last(),
                'email'   => $user->getEmail(),
                'password'=> \Hash::make($user->token)
            ]);

            \Auth::login($create, true);

            return $create;
        }
    }

    /**
     * Update a model.
     *
     * @param string $id
     * @return User
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(string $id): User
    {
        // TODO: Implement update() method.
    }
}
