<?php

namespace App;

use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Vision extends Model
{
    use HasUUID, SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'body', 'created_by',
    ];

    #############################
    ### ACCESSORS             ###
    #############################

    /**
     * Return if it's defined by default.
     *
     * @return string
     */
    public function getDefaultAttribute()
    {
        return (bool) is_null($this->created_by);
    }

    #############################
    ### MUTATORS              ###
    #############################

    /**
     * Remove whitespaces in JSON body
     *
     * @param  string  $value
     * @return void
     */
    public function setBodyAttribute($value)
    {
        $this->attributes['body'] = json_encode(json_decode($value));
    }

    #############################
    ### SCOPES                ###
    #############################

    /**
     * Local scope to retrieve top level records
     */
    public static function scopeUserDefined()
    {
        return self::whereNotNull('created_by');
    }

    #############################
    ### CHILD OF              ###
    #############################

    /**
     * Get user data for the relation.
     */
    public function creator()
    {
        return $this->belongsTo('App\User', 'created_by', 'id');
    }

}
