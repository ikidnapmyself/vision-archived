<?php

namespace App\Models;

use App\Traits\HasDate;
use App\Traits\HasUUID;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assignee extends Model
{
    use HasDate, HasUUID, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'assigned_by', 'user_id', 'task_id', 'due', 'defer', 'estimated_time', 'blocker',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'due',
        'defer',
        'completed_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Make the field human readable.
     *
     * @var string
     */
    protected $date_field = 'due';

    /**
     * Determine if assignation has been expired.
     *
     * @return bool
     * @throws \Exception
     */
    public function getExpiredAttribute(): bool
    {
        $date = new Carbon();
        $date->format('Y-m-d H:i:s');
        $expiry = (bool) ($this->due && $date > $this->due);

        return (bool) $expiry;
    }

    /**
     * Calculates due date - estimated time.
     *
     * @return null|string
     * @throws \Exception
     */
    public function getMustStartUntilAttribute(): ?string
    {
        if ($this->due && $this->estimated_time) {
            $date = new Carbon($this->due);
            $date->subMinutes($this->estimated_time)->format('Y-m-d H:i:s');

            return $date;
        }

        return null;
    }

    /**
     * Determine if assignation is deferred.
     *
     * @return bool
     * @throws \Exception
     */
    public function getDeferredAttribute(): bool
    {
        if ($this->defer) {
            return new Carbon($this->defer) > Carbon::now();
        }

        return false;
    }

    /**
     * Get user data for the relation.
     */
    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by', 'id');
    }

    /**
     * Get user data for the relation.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get user data for the relation.
     */
    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id', 'id');
    }
}
