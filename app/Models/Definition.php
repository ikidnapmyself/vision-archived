<?php

namespace App;

use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Definition extends Model
{
    use HasUUID, SoftDeletes, HasRoles;

    const PROJECT  = 0;
    const DOCUMENT = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'name', 'body',
    ];

    /**
     * Get definition type
     *
     * @return string
     */
    public function getDefinitionTypeAttribute()
    {
        if($this->type === self::PROJECT)
        {
            return 'project';
        } else if($this->type === self::DOCUMENT) {
            return 'document';
        }
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
    public function setTypeAttribute($value)
    {
        if($value === 'project')
        {
            $this->attributes['type'] = self::PROJECT;
        } else {
            $this->attributes['type'] = self::DOCUMENT;
        }
    }

    #############################
    ### SCOPES                ###
    #############################

    /**
     * Local scope to retrieve top level records
     */
    public static function scopeProject()
    {
        return self::where('type', self::PROJECT);
    }

    /**
     * Local scope to retrieve top level records
     */
    public static function scopeDocument()
    {
        return self::where('type', self::DOCUMENT);
    }

    /**
     * Get top definition
     */
    public function top()
    {
        return $this->belongsTo('App\Definition', 'id', 'top_id');
    }

    /**
     * Get parent definition
     */
    public function parent()
    {
        return $this->belongsTo('App\Definition', 'id', 'parent_id');
    }

    /**
     * Get all files.
     */
    public function files()
    {
        return $this->morphMany('App\File', 'parent');
    }
}
