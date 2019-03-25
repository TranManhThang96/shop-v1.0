<?php
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Models\Customer::class, function (Faker $faker) {
    return [
        'code' => Str::random(10),
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
    ];
});
