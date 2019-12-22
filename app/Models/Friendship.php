<?php

namespace App\Models;

use App\Traits\HasUUID;
use Hootlex\Friendships\Models\Friendship as BaseFriendship;

class Friendship extends BaseFriendship
{
    use HasUUID;
}
