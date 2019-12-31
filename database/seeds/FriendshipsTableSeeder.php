<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class FriendshipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $test     = User::where('email', 'test@test.com')->first();
        User::all()->each(function ($user) use ($test) {
            /**
             * @var User $test
             * @var User $user
             */
            $check = $test->befriend($user);
            $check === true ? $test->acceptFriendRequest($user) : false;
        });

        for ($count = 0; $count < 350; $count++) {
            /** @var User $sender */
            $sender    = User::inRandomOrder()->first();
            /** @var User $recipient */
            $recipient = User::inRandomOrder()->first();

            if (false === $sender->canBefriend($recipient)) {
                $recipient = factory(User::class)->create();
            }

            $sender->befriend($recipient);
            $sender->acceptFriendRequest($recipient);
        }
    }
}
