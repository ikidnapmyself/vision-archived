<?php

namespace App\Observers;

use App\Models\Definition;

class DefinitionObserver
{
    /**
     * Handle the definition "created" event.
     *
     * @param  \App\Models\Definition  $definition
     * @return void
     */
    public function created(Definition $definition)
    {
        //
    }

    /**
     * Handle the definition "updated" event.
     *
     * @param  \App\Models\Definition  $definition
     * @return void
     */
    public function updated(Definition $definition)
    {
        //
    }

    /**
     * Handle the definition "deleted" event.
     *
     * @param  \App\Models\Definition  $definition
     * @return void
     */
    public function deleted(Definition $definition)
    {
        //
    }

    /**
     * Handle the definition "restored" event.
     *
     * @param  \App\Models\Definition  $definition
     * @return void
     */
    public function restored(Definition $definition)
    {
        //
    }

    /**
     * Handle the definition "force deleted" event.
     *
     * @param  \App\Models\Definition  $definition
     * @return void
     */
    public function forceDeleted(Definition $definition)
    {
        //
    }
}
