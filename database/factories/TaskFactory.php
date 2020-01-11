<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    $boolean = $faker->boolean;
    $project = Project::inRandomOrder()->first();
    $user = User::inRandomOrder()->first();

    return [
        'project_id'   => $boolean ? $project->id : null,
        'name'         => $boolean ? $project->name : $faker->sentence,
        'body'         => $faker->paragraph,
        'flagged'      => $faker->boolean ?? ! (bool) rand(0, 2),
        'created_by'   => $user->id,
        'completed_by' => null,
    ];
});
