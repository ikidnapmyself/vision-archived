<?php

namespace App\Models;

use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Definition extends Model
{
    use HasUUID, SoftDeletes;

    const PROJECT = 0;
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
     * Get definition type.
     *
     * @return string
     */
    public function getDefinitionTypeAttribute()
    {
        if ($this->type === self::PROJECT) {
            return 'project';
        } elseif ($this->type === self::DOCUMENT) {
            return 'document';
        }
    }

    /**
     * Remove whitespaces in JSON body.
     *
     * @param  string  $value
     * @return void
     */
    public function setTypeAttribute($value)
    {
        if ($value === 'project') {
            $this->attributes['type'] = self::PROJECT;
        } else {
            $this->attributes['type'] = self::DOCUMENT;
        }
    }

    /**
     * Local scope to retrieve top level records.
     */
    public static function scopeProject()
    {
        return self::where('type', self::PROJECT);
    }

    /**
     * Local scope to retrieve top level records.
     */
    public static function scopeDocument()
    {
        return self::where('type', self::DOCUMENT);
    }

    /**
     * @todo make it trait
     * Get all files.
     */
    public function files()
    {
        return $this->morphMany('App\Models\File', 'parent');
    }
}
