<?php

namespace App\Services;

use App\Interfaces\Services\IntegrationServiceInterface;
use App\Models\Integration;
use App\Models\User;
use App\Repositories\IntegrationRepository;
use Laravel\Socialite\Contracts\User as SocialiteUser;

class IntegrationService implements IntegrationServiceInterface
{
    /**
     * @var IntegrationRepository
     */
    public $repository;

    /**
     * IntegrationService constructor.
     *
     * @param  IntegrationRepository  $repository
     */
    public function __construct(IntegrationRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function exists(SocialiteUser $user, string $provider): bool
    {
        $find = $this->repository->with('user')->findWhere([
            'provider_name' => $provider,
            'provider_id'   => $user->getId(),
        ])->count();

        return (bool) $find;
    }

    /**
     * @inheritDoc
     */
    public function integrate(User $user, SocialiteUser $socialiteUser, string $provider): Integration
    {
        $find = $this->repository->create([
            'user_id'       => $user->id,
            'provider_name' => $provider,
            'provider_id'   => $socialiteUser->getId(),
            'access_token'  => $socialiteUser->token,
            'profile'       => $socialiteUser->user,
        ]);

        return $find;
    }

    /**
     * @inheritDoc
     */
    public function retrieve(SocialiteUser $user, string $provider): Integration
    {
        $find = $this->repository->with('user')->findWhere([
            'provider_name' => $provider,
            'provider_id'   => $user->getId(),
        ])->first();

        return $find;
    }
}
