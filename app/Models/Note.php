<?php

namespace App;

use App\Scopes\NoteScope;
use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Note extends Model
{
    use HasUUID, SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'notable_id', 'notable_type', 'body',
    ];

    /**
     * Eager load models.
     *
     * @var array
     */
    protected $with = [
        'user',
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

        static::addGlobalScope(new NoteScope);
    }

    //############################
    //## ACCESSORS             ###
    //############################

    /**
     * Get expected top_id for top level ids.
     *
     * @return string
     */
    public function getTypeNameAttribute()
    {
        $notableType = $this->notable_type;
        $modelName = last(explode('\\', $notableType));

        return strtolower($modelName);
    }

    /**
     * Get parent resource class.
     *
     * @return string
     */
    public function getResourceClassAttribute()
    {
        $parse = explode('\\', $this->notable_type);

        $model = array_pop($parse);

        return "\App\Http\Resources\\{$model}Resource";
    }

    //############################
    //## MUTATORS              ###
    //############################

    /**
     * Set the user's name.
     *
     * @param  string  $value
     * @return void
     */
    public function setNotableTypeAttribute($value)
    {
        $this->attributes['notable_type'] = 'App\\'.ucfirst($value);
    }

    /**
     * Get all of the owning notable models.
     */
    public function notable()
    {
        return $this->morphTo();
    }

    //############################
    //## PARENT OF             ###
    //############################

    /**
     * Get all files.
     */
    public function files()
    {
        return $this->morphMany('App\File', 'parent');
    }

    //############################
    //## CHILD OF              ###
    //############################

    /**
     * Get parent data for the relation.
     */
    public function parent()
    {
        return $this->belongsTo($this->notable_type, 'notable_id', 'id');
    }

    /**
     * Get user data for the relation.
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
