<?php

namespace App;

use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Tag extends Model
{
    use HasUUID, HasRoles;

    /**
     * Disable timestamps.
     * @var bool
     */
    public $timestamps = false;

    //############################
    //## MUTATORS              ###
    //############################

    /**
     * Set the user's name.
     *
     * @param  string  $value
     * @return void
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = title_case($value);
    }

    /**
     * Get all of the owning taggable models.
     */
    public function taggable()
    {
        return $this->morphTo();
    }

    /**
     * Get all of the definitions that are assigned this tag.
     */
    public function definitions()
    {
        return $this->morphedByMany('App\Definition', 'taggable');
    }

    /**
     * Get all of the tasks that are assigned this tag.
     */
    public function tasks()
    {
        return $this->morphedByMany('App\Task', 'taggable');
    }

    /**
     * Get all of the users that are assigned this tag.
     */
    public function users()
    {
        return $this->morphedByMany('App\User', 'taggable');
    }

    /**
     * Get all of the variables that are assigned this tag.
     */
    public function variables()
    {
        return $this->morphedByMany('App\Variable', 'taggable');
    }
}
