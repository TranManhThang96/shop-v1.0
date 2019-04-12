<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Models\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'slug' => Str::slug($faker->name),
        'short_description' => $faker->text,
        'content' => 'abc'
    ];
});
