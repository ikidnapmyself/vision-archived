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

        try {
            factory(User::class, 200)->create();
        } catch (PDOException $e) {
            dump("PDOException: SQLSTATE[{$e->getCode()}] Ignored");
        }
    }
}
