<?php

namespace App;

use App\Scopes\TaskScope;
use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;


class Task extends Model
{
    use HasUUID, SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id', 'name', 'body', 'status', 'starred'
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = self::HasUUID();
        });

        static::addGlobalScope(new TaskScope);
    }

    #############################
    ### ACCESSORS             ###
    #############################

    /**
     * Get expected top_id for top level ids
     *
     * @return string
     */
    public function getTopLevelIdAttribute()
    {
        return $this->top_id ? $this->top_id : $this->id;
    }

    /**
     * Get the class name
     *
     * @return string
     */
    public function getTypeNameAttribute()
    {
        return 'App\Task';
    }

    /**
     * Get the class name
     *
     * @return string
     */
    public function getStatusNameAttribute()
    {
        return $this->status;
    }

    #############################
    ### SCOPES                ###
    #############################

    /**
     * Local scope to retrieve top level records
     */
    public static function scopeRoot()
    {
        return self::whereNull('top_id');
    }

    #############################
    ### CHILD OF              ###
    #############################

    /**
     * Get project
     */
    public function project()
    {
        return $this->belongsTo('App\Project', 'project_id', 'id');
    }

    /**
     * Get top task
     */
    public function top()
    {
        return $this->hasOne('App\Task', 'id', 'top_id');
    }

    /**
     * Get parent task
     */
    public function parent()
    {
        return $this->hasOne('App\Task', 'id', 'parent_id');
    }

    #############################
    ### PARENT OF             ###
    #############################

    /**
     * Get children variables
     */
    public function __children()
    {
        return $this->hasMany('App\Task', 'top_id', 'id');
    }

    /**
     * Get children variables
     */
    public function _children()
    {
        return $this->hasMany('App\Task', 'parent_id', 'id');
    }

    /**
     * Get children tasks
     */
    public function children()
    {
        return $this->_children()->with('children');
    }

    /**
     * Get all of the post's assignees.
     */
    public function assignees()
    {
        return $this->hasMany('App\Assignee', 'task_id', 'id');
    }

    /**
     * Get all of the tags for the task.
     */
    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }

    /**
     * Get all of the categories for the tasks.
     */
    public function categories()
    {
        return $this->morphToMany('App\Category', 'categorizable');
    }

    /**
     * Get all of the post's comments.
     */
    public function notes()
    {
        return $this->morphMany('App\Note', 'notable');
    }

    /**
     * Get all files.
     */
    public function files()
    {
        return $this->morphMany('App\File', 'parent');
    }

    /**
     * Get completed by.
     */
    public function completedBy()
    {
        return $this->hasOne('App\User', 'id', 'completed_by');
    }
}
