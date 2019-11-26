<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'name'    => 'Test',
            'surname' => 'User',
            'email'   => 'test@test.com',
        ]);
        factory(User::class, 9)->create();
    }
}
