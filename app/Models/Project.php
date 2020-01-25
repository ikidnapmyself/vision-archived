<?php

namespace App\Models;

use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasUUID, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'board_id', 'name', 'type', 'due', 'defer', /* 'status', */ 'starred', 'flagged', 'last_action_complete',
        'completed_at',
    ];

    /**
     * Get board of the project.
     */
    public function board()
    {
        return $this->belongsTo('App\Models\Board');
    }

    /**
     * Get children tasks with assignees.
     */
    public function tasks()
    {
        return $this->hasMany('App\Models\Task', 'project_id');
    }

    /**
     * Get children tasks.
     */
    public function assignees()
    {
        return $this->hasManyThrough('App\Models\Assignee', 'App\Task');
    }
}
