<?php

namespace App\Observers;

use App\Models\Assignee;

class AssigneeObserver
{
    /**
     * Handle the assignee "created" event.
     *
     * @param  \App\Models\Assignee  $assignee
     * @return void
     */
    public function created(Assignee $assignee)
    {
        //
    }

    /**
     * Handle the assignee "updated" event.
     *
     * @param  \App\Models\Assignee  $assignee
     * @return void
     */
    public function updated(Assignee $assignee)
    {
        //
    }

    /**
     * Handle the assignee "deleted" event.
     *
     * @param  \App\Models\Assignee  $assignee
     * @return void
     */
    public function deleted(Assignee $assignee)
    {
        //
    }

    /**
     * Handle the assignee "restored" event.
     *
     * @param  \App\Models\Assignee  $assignee
     * @return void
     */
    public function restored(Assignee $assignee)
    {
        //
    }

    /**
     * Handle the assignee "force deleted" event.
     *
     * @param  \App\Models\Assignee  $assignee
     * @return void
     */
    public function forceDeleted(Assignee $assignee)
    {
        //
    }
}
