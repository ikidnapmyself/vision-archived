<?php

namespace App\Traits;

use Carbon\Carbon;

trait HasDate
{
    /**
     * Base date field.
     *
     * @var string $field_name
     */
    private $field_name = 'created_at';

    /**
     * This method is called upon instantiation of the Eloquent Model.
     *
     * @return void
     */
    public function initializeHasDate()
    {
        $this->append(['ago', 'date']);
    }

    /**
     * Get human readable difference of the date.
     *
     * @return string
     */
    public function getAgoAttribute()
    {
        return $this->{$this->field_name}->diffForHumans();
    }

    /**
     * Get human readable difference of the date.
     *
     * @return string
     */
    public function getDateAttribute()
    {
        return date("j F Y, H:i", $this->{$this->field_name}->timestamp);
    }
}
