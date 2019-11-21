<?php

namespace App;

use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Category extends Model
{
    use HasUUID, SoftDeletes, HasRoles;

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

    #############################
    ### MUTATORS              ###
    #############################

    /**
     * Set the user's name
     *
     * @param  string  $value
     * @return void
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = title_case($value);
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
     * Get top definition
     */
    public function top()
    {
        return $this->belongsTo('App\Category', 'id', 'top_id');
    }

    /**
     * Get parent definition
     */
    public function parent()
    {
        return $this->belongsTo('App\Category', 'id', 'parent_id');
    }

    #############################
    ### PARENT OF             ###
    #############################

    /**
     * Get children variables
     */
    public function __children()
    {
        return $this->hasMany('App\Category', 'top_id', 'id');
    }

    /**
     * Get children categories
     */
    public function _children()
    {
        return $this->hasMany('App\Category', 'parent_id', 'id');
    }

    /**
     * Get children categories recursively
     */
    public function children()
    {
        return $this->_children()->with('children');
    }

    /**
     * Get all of the owning categorizable models.
     */
    public function categorizable()
    {
        return $this->morphTo();
    }

    /**
     * Get all of the definitions that are assigned this category.
     */
    public function definitions()
    {
        return $this->morphedByMany('App\Definition', 'categorizable');
    }

    /**
     * Get all of the tasks that are assigned this category.
     */
    public function tasks()
    {
        return $this->morphedByMany('App\Task', 'categorizable');
    }

    /**
     * Get all of the variables that are assigned this category.
     */
    public function variables()
    {
        return $this->morphedByMany('App\Variable', 'categorizable');
    }
}
