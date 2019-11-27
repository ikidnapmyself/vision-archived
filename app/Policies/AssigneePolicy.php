<?php

namespace App\Policies;

use App\Models\Assignee;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AssigneePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any assignees.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the assignee.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Assignee  $assignee
     * @return mixed
     */
    public function view(User $user, Assignee $assignee)
    {
        //
    }

    /**
     * Determine whether the user can create assignees.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the assignee.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Assignee  $assignee
     * @return mixed
     */
    public function update(User $user, Assignee $assignee)
    {
        //
    }

    /**
     * Determine whether the user can delete the assignee.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Assignee  $assignee
     * @return mixed
     */
    public function delete(User $user, Assignee $assignee)
    {
        //
    }

    /**
     * Determine whether the user can restore the assignee.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Assignee  $assignee
     * @return mixed
     */
    public function restore(User $user, Assignee $assignee)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the assignee.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Assignee  $assignee
     * @return mixed
     */
    public function forceDelete(User $user, Assignee $assignee)
    {
        //
    }
}
