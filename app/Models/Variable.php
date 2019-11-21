<?php

namespace App;

use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Variable extends Model
{
    use HasUUID, SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id', 'name', 'body',
    ];

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
     * Get the variable's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->parent_name ? "{$this->parent_name}.{$this->name}" : $this->name;
    }

    /**
     * Get the class name
     *
     * @return string
     */
    public function getTypeNameAttribute()
    {
        return 'App\Variables';
    }

    /**
     * Get depth of a variable
     *
     * @return int
     */
    public function getDepthAttribute()
    {
        if(!$this->parent_name)
        {
            return 1;
        }

        $count = count(explode('.', $this->parent_name)) + 1;

        return $count;
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
        $this->attributes['name'] = strtolower($value);
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
        return $this->belongsTo('App\Variable', 'id', 'top_id');
    }

    /**
     * Get parent definition
     */
    public function parent()
    {
        return $this->belongsTo('App\Variable', 'id', 'parent_id');
    }

    #############################
    ### PARENT OF             ###
    #############################

    /**
     * Get children variables
     */
    public function __children()
    {
        return $this->hasMany('App\Variable', 'top_id', 'id');
    }

    /**
     * Get children variables
     */
    public function _children()
    {
        return $this->hasMany('App\Variable', 'parent_id', 'id');
    }

    /**
     * Get children variables recursively
     */
    public function children()
    {
        return $this->_children()->with('children');
    }

    /**
     * Get all of the tags for the task.
     */
    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }

    /**
     * Get all of the categories for the variable.
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
}
