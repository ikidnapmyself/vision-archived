<?php

namespace App\Observers;

use App\Models\Friendship;

class FriendshipObserver
{
    /**
     * Handle the team "created" event.
     *
     * @param  Friendship  $team
     * @return void
     */
    public function created(Friendship $team)
    {
        //
    }

    /**
     * Handle the team "updated" event.
     *
     * @param  Friendship  $team
     * @return void
     */
    public function updated(Friendship $team)
    {
        //
    }

    /**
     * Handle the team "deleted" event.
     *
     * @param  Friendship  $team
     * @return void
     */
    public function deleted(Friendship $team)
    {
        //
    }

    /**
     * Handle the team "restored" event.
     *
     * @param  Friendship  $team
     * @return void
     */
    public function restored(Friendship $team)
    {
        //
    }

    /**
     * Handle the team "force deleted" event.
     *
     * @param  Friendship  $team
     * @return void
     */
    public function forceDeleted(Friendship $team)
    {
        //
    }
}
