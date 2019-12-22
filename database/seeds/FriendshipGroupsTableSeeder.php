<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class FriendshipGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($count = 0; $count < 50; $count++) {
            $group   = collect(config('friendships.groups'))->keys()->random();
            /** @var User $user */
            $user    = User::inRandomOrder()->first();
            $friends = $user->getFriends();
            /** @var User $friend */
            $friend  = $friends->count() ? $friends->random() : null;

            if (is_null($friend)) {
                dump('User has no friend');
                continue;
            }

            try {
                $user->groupFriend($friend, $group);
            } catch (PDOException $e) {
                dump("PDOException: SQLSTATE[{$e->getCode()}] Ignored");
            }
        }
    }
}
