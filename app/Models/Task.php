<?php

namespace App\Models;

use App\Traits\HasStatuses;
use App\Traits\HasUrl;
use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasStatuses, HasUrl, HasUUID, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id', 'name', 'body', 'flagged', 'order', 'created_by', 'completed_by',
    ];

    /**
     * Get board.
     */
    public function board()
    {
        return $this->belongsTo(Board::class);
    }

    /**
     * Get project.
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get all of the assignees (not users).
     */
    public function assignees()
    {
        return $this->hasMany(Assignee::class, 'task_id');
    }

    /**
     * Created by.
     */
    public function createdBy()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    /**
     * Completed by.
     */
    public function completedBy()
    {
        return $this->hasOne(Assignee::class, 'completed_by');
    }

    /**
     * Get all files.
     */
    public function files()
    {
        return $this->morphMany(File::class, 'parent');
    }
}
