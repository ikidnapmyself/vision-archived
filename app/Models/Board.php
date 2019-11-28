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
        'name', 'description', 'is_public',
    ];

    /**
     * Get all of the projects of the board.
     */
    public function projects()
    {
        return $this->hasMany('App\Models\Project', 'board_id', 'id');
    }

    /**
     * Board owner.
     */
    public function owner()
    {
        return $this->hasMany('App\Models\Project', 'board_id', 'id');
    }
}
