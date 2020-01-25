<?php

namespace App\Models;

use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Board extends Model
{
    use HasUUID, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'is_public', 'morph_type', 'morph_id',
    ];

    /**
     * Board owner. Get the owning morph model.
     */
    public function morph()
    {
        return $this->morphTo();
    }
}
