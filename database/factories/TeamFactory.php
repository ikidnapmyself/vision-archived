<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Team;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Team::class, function (Faker $faker) {
    $name = $faker->company;

    return [
        'user_id'     => User::inRandomOrder()->first()->id,
        'name'        => Str::title($name),
        'description' => $faker->sentence,
        'slug'        => Str::slug($name),
    ];
});
