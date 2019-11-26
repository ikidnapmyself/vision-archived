<?php

namespace App\Observers;

use App\Models\Member;
use App\Models\Team;

class TeamObserver
{
    /**
     * Handle the team "created" event.
     *
     * @param  Team  $team
     * @return void
     */
    public function created(Team $team)
    {
       Member::create([
            'team_id' => $team->id,
            'user_id' => $team->user_id,
       ]);
    }

    /**
     * Handle the team "updated" event.
     *
     * @param  Team  $team
     * @return void
     */
    public function updated(Team $team)
    {
        //
    }

    /**
     * Handle the team "deleted" event.
     *
     * @param  Team  $team
     * @return void
     */
    public function deleted(Team $team)
    {
        $team->members()->delete();
    }

    /**
     * Handle the team "restored" event.
     *
     * @param  Team  $team
     * @return void
     */
    public function restored(Team $team)
    {
        $team->members()->withTrashed()->restore();
    }

    /**
     * Handle the team "force deleted" event.
     *
     * @param  Team  $team
     * @return void
     */
    public function forceDeleted(Team $team)
    {
        $team->members()->forceDelete();
    }
}
