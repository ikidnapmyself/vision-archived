<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Project;
use App\Models\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {

    $project = Project::inRandomOrder()->first();
    $boolean = $faker->boolean;
    return [
        'project_id'   => $boolean ? $project->id : null,
        'name'         => $boolean ? $project->name : $faker->sentence,
        'body'         => $faker->paragraph,
        'starred'      => $faker->boolean ?? ! (boolean) rand(0, 2),
        'flagged'      => $faker->boolean ?? ! (boolean) rand(0, 2),
        'completed_by' => null,
    ];
});
