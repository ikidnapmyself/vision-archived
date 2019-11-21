<?php

namespace App;

use Laravel\Passport\Client as PassportOriginalClient;

class Client extends PassportOriginalClient
{
    /**
     * Get user of a client.
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'id', 'user_id');
    }
}
