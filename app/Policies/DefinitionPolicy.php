<?php

namespace App\Policies;

use App\Models\Definition;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DefinitionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any definitions.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the definition.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Definition  $definition
     * @return mixed
     */
    public function view(User $user, Definition $definition)
    {
        //
    }

    /**
     * Determine whether the user can create definitions.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the definition.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Definition  $definition
     * @return mixed
     */
    public function update(User $user, Definition $definition)
    {
        //
    }

    /**
     * Determine whether the user can delete the definition.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Definition  $definition
     * @return mixed
     */
    public function delete(User $user, Definition $definition)
    {
        //
    }

    /**
     * Determine whether the user can restore the definition.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Definition  $definition
     * @return mixed
     */
    public function restore(User $user, Definition $definition)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the definition.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Definition  $definition
     * @return mixed
     */
    public function forceDelete(User $user, Definition $definition)
    {
        //
    }
}
