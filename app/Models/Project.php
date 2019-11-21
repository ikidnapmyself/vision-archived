<?php

namespace App;

use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Project extends Model
{
    use HasUUID, SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    #############################
    ### PARENT OF             ###
    #############################

    /**
     * Get children tasks
     */
    public function topChildren()
    {
        return $this->hasMany('App\Task', 'project_id', 'id')->whereNull('top_id');
    }


    /**
     * Get children tasks
     */
    public function children()
    {
        return $this->hasMany('App\Task', 'project_id', 'id')->whereNull('top_id')->with(['children', 'assignees']);
    }


    /**
     * Get children tasks with assignees
     */
    public function withAssignees()
    {
        return $this->hasMany('App\Task', 'project_id', 'id')->whereNull('top_id')->with(['children', 'assignees']);
    }

    /**
     * Get children tasks
     */
    public function allRelations()
    {
        return $this->hasManyThrough('App\Assignee', 'App\Task');
    }
}
