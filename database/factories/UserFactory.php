<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $name = $faker->firstName;
    $surname = $faker->lastName;
    $email = Str::slug("{$name} {$surname}", '.');

    return [
        'name'              => $name,
        'surname'           => $surname,
        'email'             => "{$email}@test.com",
        'email_verified_at' => now(),
        'password'          => Hash::make('123456'),
        'remember_token'    => Str::random(10),
    ];
});
