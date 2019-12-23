<?php

namespace App\Traits;

use Illuminate\Support\Carbon;

trait HasDate
{
    /**
     * This method is called upon instantiation of the Eloquent Model.
     *
     * @return void
     */
    public function initializeHasDate(): void
    {
        $this->append(['ago', 'date']);
    }

    /**
     * Get date field name.
     *
     * @return string
     */
    protected function getDateFieldName(): string
    {
        return $this->date_field ?? 'created_at';
    }

    /**
     * Get chosen date field to modify.
     *
     * @return null|Carbon
     */
    protected function getDateField(): ?Carbon
    {
        $field = $this->getDateFieldName();

        return $this->$field;
    }

    /**
     * Get human readable difference of the date.
     *
     * @return null|string
     */
    public function getAgoAttribute(): ?string
    {
        $field = $this->getDateField();

        return $field ? $field->diffForHumans() : null;
    }

    /**
     * Get human readable difference of the date.
     *
     * @return null|string
     */
    public function getDateAttribute(): ?string
    {
        $field = $this->getDateField();

        return $field ? date('j F Y, H:i', $field->timestamp) : null;
    }
}
