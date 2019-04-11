<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'short_description' => $faker->text,
        'content' => 'abc'
    ];
});
