<?php
namespace App\Models;

use App\Traits\HasUUID;
use Hootlex\Friendships\Models\FriendFriendshipGroups as BaseModel;

class FriendFriendshipGroups extends BaseModel
{
    use HasUUID;
}
