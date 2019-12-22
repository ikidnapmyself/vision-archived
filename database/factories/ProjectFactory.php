<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Board;
use App\Models\Project;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {
    $condition = $faker->boolean;

    if ($condition) {
        $now = Carbon::now();
        $future = $faker->boolean;
        if ($future) {
            $when = rand(1, 30);
            $length = rand(1, 14);
            $defer = $faker->boolean ? $now->addDays($when) : null;
            $due = (null !== $defer ? $defer : $now)->addDays($length);
        }
    }

    $starred = (bool) rand(0, 5);
    $flagged = (bool) rand(0, 5);

    $board = Board::inRandomOrder()->first();

    return [
        'board_id'   => $faker->boolean ? $board->id : null,
        'name'       => $faker->sentence,
        'type'       => 0, // No idea yet
        'due'        => $due ?? null,
        'defer'      => $defer ?? null,
        //'status'     => '',
        'starred'    => $starred,
        'flagged'    => $flagged,
    ];
});
