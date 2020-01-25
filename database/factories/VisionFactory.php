<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Vision::class, function (Faker $faker) {
    $creator = \App\Models\User::inRandomOrder()->first()->id;

    return [
        'name'       => $faker->word,
        'body'       => '{"condition":"AND","rules":[{"id":"assignees.user_id","field":"assignees.user_id","type":"string","input":"select","operator":"equal","value":"494c41c9-2af4-432b-bdf3-8891913b9a36"},{"id":"assignees.defer","field":"assignees.defer","type":"datetime","input":"text","operator":"not_equal","value":"2018-08-08"},{"id":"projects.flagged","field":"projects.flagged","type":"boolean","input":"select","operator":"equal","value":true}],"valid":true}',
        'created_by' => $creator,
    ];
});
