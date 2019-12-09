<?php

namespace App\Models;

use App\Traits\HasStatuses;
use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasStatuses, HasUUID, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id', 'name', 'body', 'starred', 'flagged', 'order', 'completed_by'
    ];

    protected $appends = [
        'available_statuses', 'status'
    ];

    /**
     * Get project.
     */
    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    /**
     * Get all of the assignees (not users).
     */
    public function assignees()
    {
        return $this->hasMany('App\Models\Assignee', 'task_id');
    }

    /**
     * Completed by.
     */
    public function completed_by()
    {
        return $this->hasOne('App\Models\Assignee', 'completed_by');
    }

    /**
     * Get all files.
     */
    public function files()
    {
        return $this->morphMany('App\Models\File', 'parent');
    }
}
