<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            TeamsTableSeeder::class,
            BoardsTableSeeder::class,
            ProjectsTableSeeder::class,
            DefinitionsTableSeeder::class,
            VariablesTableSeeder::class,
            TasksTableSeeder::class,
            AssigneesTableSeeder::class,
            VisionsTableSeeder::class,
        ]);
    }
}
