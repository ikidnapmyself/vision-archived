<?php

namespace App\Models;

use App\Traits\HasRoles;
use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vision extends Model
{
    use HasUUID, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'body', 'created_by',
    ];

    /**
     * Return if it's defined by default.
     *
     * @return string
     */
    public function getDefaultAttribute()
    {
        return (bool) is_null($this->created_by);
    }

    /**
     * Remove whitespaces in JSON body.
     *
     * @param  string  $value
     * @return void
     */
    public function setBodyAttribute($value)
    {
        $this->attributes['body'] = json_encode(json_decode($value));
    }

    /**
     * Local scope to retrieve top level records.
     */
    public static function scopeUserDefined()
    {
        return self::whereNotNull('created_by');
    }

    /**
     * Get user data for the relation.
     */
    public function creator()
    {
        return $this->belongsTo('App\Models\User', 'created_by', 'id');
    }
}
