<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Variable;
use Illuminate\Auth\Access\HandlesAuthorization;

class VariablePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any variables.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the variable.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Variable  $variable
     * @return mixed
     */
    public function view(User $user, Variable $variable)
    {
        //
    }

    /**
     * Determine whether the user can create variables.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the variable.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Variable  $variable
     * @return mixed
     */
    public function update(User $user, Variable $variable)
    {
        //
    }

    /**
     * Determine whether the user can delete the variable.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Variable  $variable
     * @return mixed
     */
    public function delete(User $user, Variable $variable)
    {
        //
    }

    /**
     * Determine whether the user can restore the variable.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Variable  $variable
     * @return mixed
     */
    public function restore(User $user, Variable $variable)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the variable.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Variable  $variable
     * @return mixed
     */
    public function forceDelete(User $user, Variable $variable)
    {
        //
    }
}
