<?php

namespace App\Observers;

use App\Models\Vision;

class VisionObserver
{
    /**
     * Handle the vision "created" event.
     *
     * @param  \App\Models\Vision  $vision
     * @return void
     */
    public function created(Vision $vision)
    {
        //
    }

    /**
     * Handle the vision "updated" event.
     *
     * @param  \App\Models\Vision  $vision
     * @return void
     */
    public function updated(Vision $vision)
    {
        //
    }

    /**
     * Handle the vision "deleted" event.
     *
     * @param  \App\Models\Vision  $vision
     * @return void
     */
    public function deleted(Vision $vision)
    {
        //
    }

    /**
     * Handle the vision "restored" event.
     *
     * @param  \App\Models\Vision  $vision
     * @return void
     */
    public function restored(Vision $vision)
    {
        //
    }

    /**
     * Handle the vision "force deleted" event.
     *
     * @param  \App\Models\Vision  $vision
     * @return void
     */
    public function forceDeleted(Vision $vision)
    {
        //
    }
}
