<?php

use Illuminate\Database\Seeder;

class AssigneesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Assignee::class, 1000)->create([
            'assigned_by' => \App\Models\User::inRandomOrder()->first()->id
        ]);
    }
}
