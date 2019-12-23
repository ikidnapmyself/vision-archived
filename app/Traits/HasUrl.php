<?php

namespace App\Traits;

trait HasUrl
{
    /**
     * This method is called upon instantiation of the Eloquent Model.
     *
     * @return void
     */
    public function initializeHasUrl()
    {
        $this->append(['url']);
    }

    /**
     * Get URL of current model.
     *
     * @return bool
     */
    public function getUrlAttribute()
    {
        return route('task.show', ['task' => $this->id]);
    }
}
