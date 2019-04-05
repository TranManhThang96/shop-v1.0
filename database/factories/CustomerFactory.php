<?php
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

$factory->define(App\Models\Customer::class, function (Faker $faker) {
    return [
        'code' => Str::random(10),
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'sex' => $faker->numberBetween(1,2),
        'age' => $faker->numberBetween(20,100),
        'user_name' => $faker->userName,
        'password' => encrypt('12345'),
        'phone' => $faker->phoneNumber,
        'address' => $faker->address
    ];
});
