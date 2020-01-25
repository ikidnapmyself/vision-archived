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
     * @var UserRepository $repository
     */
    public $repository;

    /**
     * @var IntegrationServiceInterface $integrationService
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
     * @inheritDoc
     */
    public function integrate(SocialiteUser $user, string $provider): User
    {
        $exists = $this->integrationService->exists($user, $provider);

        if ($exists) {
            /**
             * @var User $retrieve
             */
            $retrieve = $this->integrationService->retrieve($user, $provider);

            return $retrieve->user;
        } else {
            $username = collect(
                explode(' ', $user->getName())
            );

            $created = $this->repository
                ->create([
                    'name'    => $username->first(),
                    'surname' => $username->last(),
                    'email'   => $user->getEmail(),
                ])
                ->integrations()->create([
                    'provider_name' => $provider,
                    'provider_id'   => $user->getId(),
                    'access_token'  => $user->token,
                ]);

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
