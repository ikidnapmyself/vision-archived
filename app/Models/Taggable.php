<?php

namespace App;

use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Taggable extends Model
{
    use HasUUID, HasRoles;

    /**
     * Disable timestamps.
     *
     * @var bool
     */
    public $timestamps = false;

    #############################
    ### MUTATORS              ###
    #############################

    /**
     * Set type
     *
     * @param  string  $value
     * @return void
     */
    public function setTaggableTypeAttribute($value)
    {
        $this->attributes['taggable_type'] = mutate_type_name($value);
    }
}
