<?php

namespace App\Traits;

trait HasUrl
{
    /**
     * HasUrl constructor.
     */
    public function __construct()
    {
        $this->append('url');
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
