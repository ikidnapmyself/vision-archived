<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Definition::class, function (Faker $faker) {
    $type = collect(['project', 'document'])->random();

    if($type === 'document')
        $body = $faker->randomHtml();
    else
        $body = json_encode(['random','array','encoded','just','to','create','a','sample','json','project']);

    return [
        'type'      => $type,
        'name'      => $faker->sentence,
        'body'      => $body
    ];
});
