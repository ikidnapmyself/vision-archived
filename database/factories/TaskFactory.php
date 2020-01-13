    <?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Board;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    $project = Project::inRandomOrder()->first();
    $user    = User::inRandomOrder()->first();
    $board   = $user->boards()->inRandomOrder()->first() ?? factory(Board::class)->create();
    return [
        'board_id'     => $board->id,
        'project_id'   => $faker->boolean ? $project->id : null,
        'name'         => $faker->boolean ? $project->name : $faker->sentence,
        'body'         => $faker->paragraph,
        'flagged'      => $faker->boolean ?? ! (boolean) rand(0, 2),
        'created_by'   => $user->id,
        'completed_by' => null,
    ];
});
