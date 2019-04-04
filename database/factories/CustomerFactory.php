<?php
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Models\Customer::class, function (Faker $faker) {
    return [
        'code' => Str::random(10),
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'sex' => $faker->numberBetween(0,1),
        'age' => $faker->numberBetween(20,100),
        'user_name' => Str::random(8),
        'password' => encrypt('12345'),
        'phone' => $faker->phoneNumber,
        'address' => $faker->address
    ];
});
