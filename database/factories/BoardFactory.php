<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Board;
use App\Models\Team;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Board::class, function (Faker $faker) {
    $model = collect([
        User::class,
        Team::class
    ])->random();

    return [
        'name'        => ucfirst($faker->word),
        'description' => $faker->sentence,
        'is_public'   => $faker->boolean,
        'morph_type'  => $model,
        'morph_id'    => $model::inRandomOrder()->first()->id,
    ];
});
