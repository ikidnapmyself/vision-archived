<?php

namespace App;

use Carbon\Carbon;
use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Assignee extends Model
{
    use HasUUID, SoftDeletes, HasRoles;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'assignees';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'assigned_by', 'user_id', 'task_id', 'due', 'defer', 'estimated_time', 'blocker', 'flagged'
    ];

    #############################
    ### ACCESSORS             ###
    #############################

    /**
     * Determine if assignation has been expired.
     *
     * @return bool
     */
    public function getExpiredAttribute(): bool
    {
        $date   = new Carbon();
        $date->setToStringFormat('Y-m-d H:i:s');
        $expiry = (bool) ($this->due && $date > $this->due);

        return (bool) $expiry;
    }

    /**
     * Calculates due date - estimated time.
     *
     * @return null|string
     */
    public function getMustStartUntilAttribute(): ?string
    {
        if($this->due && $this->estimated_time)
        {
            $date   = new Carbon($this->due);
            $date->subMinutes($this->estimated_time)->setToStringFormat('Y-m-d H:i:s');

            return $date;
        }

        return null;
    }

    /**
     * Determine if assignation is deferred.
     *
     * @return bool
     */
    public function getDeferredAttribute(): bool
    {
        if($this->defer)
        {
            return new Carbon($this->defer) > Carbon::now();
        }

        return false;
    }

    #############################
    ### CHILD OF              ###
    #############################

    /**
     * Get user data for the relation.
     */
    public function assignedBy()
    {
        return $this->belongsTo('App\User', 'assigned_by', 'id');
    }

    /**
     * Get user data for the relation.
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    /**
     * Get user data for the relation.
     */
    public function assigned()
    {
        return $this->belongsTo('App\Task', 'task_id', 'id');
    }
}
