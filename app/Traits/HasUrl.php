<?php

namespace App\Traits;

use Illuminate\Support\Str;

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
     * @return string
     * @throws \ReflectionException
     */
    public function getUrlAttribute()
    {
        $class = (new \ReflectionClass($this))->getShortName();
        $key = Str::lower($class);

        return route("{$key}.show", [$key => $this->id]);
    }
}
