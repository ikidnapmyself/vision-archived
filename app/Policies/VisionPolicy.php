<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vision;
use Illuminate\Auth\Access\HandlesAuthorization;

class VisionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any visions.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the vision.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vision  $vision
     * @return mixed
     */
    public function view(User $user, Vision $vision)
    {
        //
    }

    /**
     * Determine whether the user can create visions.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the vision.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vision  $vision
     * @return mixed
     */
    public function update(User $user, Vision $vision)
    {
        //
    }

    /**
     * Determine whether the user can delete the vision.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vision  $vision
     * @return mixed
     */
    public function delete(User $user, Vision $vision)
    {
        //
    }

    /**
     * Determine whether the user can restore the vision.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vision  $vision
     * @return mixed
     */
    public function restore(User $user, Vision $vision)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the vision.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vision  $vision
     * @return mixed
     */
    public function forceDelete(User $user, Vision $vision)
    {
        //
    }
}
