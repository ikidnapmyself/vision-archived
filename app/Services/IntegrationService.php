<?php

namespace App\Services;

use App\Interfaces\IntegrationServiceInterface;
use App\Models\Integration;
use App\Repositories\IntegrationRepository;
use Laravel\Socialite\Contracts\User as SocialiteUser;

class IntegrationService implements IntegrationServiceInterface
{
    /**
     * @var IntegrationRepository $repository
     */
    public $repository;

    /**
     * IntegrationService constructor.
     *
     * @param IntegrationRepository $repository
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
    public function retrieve(SocialiteUser $user, string $provider): Integration
    {
        $find = $this->repository->with('user')->findWhere([
            'provider_name' => $provider,
            'provider_id'   => $user->getId(),
        ])->first();

        return $find;
    }
}
