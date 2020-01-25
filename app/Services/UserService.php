<?php

namespace App\Services;

use App\Http\Requests\UserCreateRequest;
use App\Interfaces\IntegrationServiceInterface;
use App\Interfaces\UserServiceInterface;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Laravel\Socialite\Contracts\User as SocialiteUser;

class UserService implements UserServiceInterface
{
    /**
     * @var UserRepository
     */
    public $repository;

    /**
     * @var IntegrationServiceInterface
     */
    public $integrationService;

    /**
     * UserService constructor.
     *
     * @param UserRepository $repository
     * @param IntegrationServiceInterface $integrationService
     */
    public function __construct(UserRepository $repository, IntegrationServiceInterface $integrationService)
    {
        $this->repository = $repository;
        $this->integrationService = $integrationService;
    }

    /**
     * {@inheritdoc}
     */
    public function index(): LengthAwarePaginator
    {
        return $this->repository->with('friends')->paginate();
    }

    /**
     * {@inheritdoc}
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
     * {@inheritdoc}
     */
    public function integrate(SocialiteUser $socialiteUser, string $provider): User
    {
        $exists = $this->integrationService->exists($socialiteUser, $provider);

        if ($exists) {
            /**
             * @var User
             */
            $retrieve = $this->integrationService->retrieve($socialiteUser, $provider);

            return $retrieve->user;
        } else {
            $username = collect(
                explode(' ', $socialiteUser->getName())
            );

            $created = $this->repository
                ->create([
                    'name' => $username->first(),
                    'surname' => $username->last(),
                    'email' => $socialiteUser->getEmail(),
                ]);

            $this->integrationService->integrate($created, $socialiteUser, $provider);

            return $created;
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
