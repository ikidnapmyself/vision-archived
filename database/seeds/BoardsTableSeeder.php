<?php

use App\Models\Board;
use Illuminate\Database\Seeder;

class BoardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * each user has ~5 boards.
         */
        factory(Board::class, 1000)->create();
    }
}
