<?php

namespace App\Interfaces\Services;

use App\Models\Integration;
use App\Models\User;
use Laravel\Socialite\Contracts\User as SocialiteUser;

interface IntegrationServiceInterface
{
    /**
     * Determine if this integration exists.
     *
     * @param SocialiteUser $user
     * @param string $provider
     * @return bool
     */
    public function exists(SocialiteUser $user, string $provider): bool;

    /**
     * Integrate and link to an account.
     *
     * @param User $user
     * @param SocialiteUser $socialiteUser
     * @param string $provider
     * @return Integration
     */
    public function integrate(User $user, SocialiteUser $socialiteUser, string $provider): Integration;

    /**
     * Retrieve user.
     *
     * @param SocialiteUser $user
     * @param string $provider
     * @return Integration
     */
    public function retrieve(SocialiteUser $user, string $provider): Integration;
}
