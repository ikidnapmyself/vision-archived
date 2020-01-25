<?php

namespace App\Models;

use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;

class Integration extends Model
{
    use HasUUID;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'imported_at', 'exported_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'provider_name', 'provider_id', 'access_token',
        'refresh_token', 'profile', 'imported_at', 'exported_at'
    ];

    /**
     * Get user.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
