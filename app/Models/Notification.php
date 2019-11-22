<?php

namespace App;

use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasUUID;

    /**
     * Action codes.
     */
    const CREATE = 1;
    const RESTORE = 2;
    const UPDATE = 3;
    const DELETE = 4;
    const INCOMPLETE = 5;
    const IN_PROGRESS = 6;
    const COMPLETE = 7;
    const ASSIGN = 8;
    const UNASSIGN = 9;
}
