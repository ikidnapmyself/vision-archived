<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Variable::class, function (Faker $faker) {
    return [
        'name'        => $faker->word,
        'body'        => $faker->paragraph,
    ];
});
