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
        for ($count = 0; $count < 350; $count++) {
            /** @var User $sender */
            $sender = User::inRandomOrder()->first();
            /** @var User $recipient */
            $recipient = User::inRandomOrder()->first();

            if (true === $sender->isFriendWith($recipient)) {
                $recipient = factory(User::class)->create();
            }

            $sender->befriend($recipient);
            $sender->acceptFriendRequest($recipient);
        }
    }
}
