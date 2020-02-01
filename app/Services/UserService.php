<?php

namespace App\Services;

use App\Http\Requests\UserCreateRequest;
use App\Interfaces\IntegrationServiceInterface;
use App\Interfaces\UserServiceInterface;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
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
        return $this->repository->with(['boards', 'friends', 'groups', 'integrations'])->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function integrate(SocialiteUser $socialiteUser, string $provider, ?User $user = null): User
    {
        $exists = $this->integrationService->exists($socialiteUser, $provider);

        if ($exists) {
            /**
             * @var User
             */
            $retrieve = $this->integrationService->retrieve($socialiteUser, $provider);

            return $retrieve->user;
        } else {
            if ($user === null) {
                $username = collect(
                    explode(' ', $socialiteUser->getName())
                );

                $user = $this->repository
                    ->create([
                        'name' => $username->first(),
                        'surname' => $username->last(),
                        'email' => $socialiteUser->getEmail(),
                    ]);
            }

            $this->integrationService->integrate($user, $socialiteUser, $provider);

            return $user;
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

    /**
     * Create a model to integrate a service.
     *
     * @param string $user
     * @return Collection
     */
    public function integrations(string $user): Collection
    {
        $find = $this->repository->find($user);

        return $find->integrations;
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
}
