<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Assignee;
use App\Models\Task;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Assignee::class, function (Faker $faker) {
    /**
     * @todo Users can only assign themselves until we use teams actively
     */
    $user = User::inRandomOrder()->first();
    $task = Task::inRandomOrder()->first();
    /**
     * @todo Generate due and defer dates regarding to project limitations.
     */
//    $project = $task->project;
//
//    if(!is_null($project))
//    {
//        if($faker->boolean)
//            $defer = $project->defer;
//        if($faker->boolean)
//            $due   = $project->due;
//    }

    return [
        'assigned_by'    => $user->id,
        'user_id'        => $user->id,
        'task_id'        => $task->id,
        'due'            => $due ?? null,
        'defer'          => $defer ?? null,
        'estimated_time' => null,
        'blocker'        => ! (bool) rand(0, 5),
        'completed_at'   => null,
    ];
});
