<?php

namespace App\Models;

use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;

class Integration extends Model
{
    use HasUUID;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'provider_name', 'provider_id'
    ];

    /**
     * Get user.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
