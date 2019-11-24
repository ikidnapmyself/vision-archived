<?php

namespace App\Models;

use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasUUID, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id', 'name', 'body', 'starred', 'flagged',
    ];

    /**
     * Get project.
     */
    public function project()
    {
        return $this->belongsTo('App\Models\Project', 'project_id', 'id');
    }

    /**
     * Get all of the post's assignees.
     */
    public function assignees()
    {
        return $this->hasMany('App\Models\Assignee', 'task_id', 'id');
    }

    /**
     * Get all files.
     */
    public function files()
    {
        return $this->morphMany('App\Models\File', 'parent');
    }

    /**
     * Get completed by.
     */
    public function completedBy()
    {
        return $this->hasOne('App\Models\User', 'id', 'completed_by');
    }
}
