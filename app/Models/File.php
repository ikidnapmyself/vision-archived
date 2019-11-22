<?php

namespace App;

use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class File extends Model
{
    use HasUUID, SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'mime_type', 'path', 'size', 'source', 'user_id', 'parent_id', 'parent_type',
    ];

    //############################
    //## ACCESSORS             ###
    //############################

    /**
     * Get parent resource class.
     *
     * @return string
     */
    public function getResourceClassAttribute()
    {
        $parse = explode('\\', $this->parent_type);

        $model = array_pop($parse);

        return "\App\Http\Resources\\{$model}Resource";
    }

    /**
     * Uploaded by.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Parent object.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo($this->parent_type);
    }
}
