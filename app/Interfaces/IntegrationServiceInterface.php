<?php

namespace App\Interfaces;

use App\Models\Integration;
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
     * Retrieve user.
     *
     * @param SocialiteUser $user
     * @param string $provider
     * @return Integration
     */
    public function retrieve(SocialiteUser $user, string $provider): Integration;
}
