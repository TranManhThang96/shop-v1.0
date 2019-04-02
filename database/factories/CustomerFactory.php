<?php
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

$factory->define(App\Models\Customer::class, function (Faker $faker) {
    return [
        'code' => Str::random(10),
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'sex' => Arr::random([1,2]),
        'age' => Arr::random([17,18,19,20,21,22,23,24,25,26,27,28,29,30]),
        'user_name' => $faker->userName,
        'password' => 12345,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'province_id' => Arr::random(getProvinces()),
        'district_id' => Arr::random(getDistrict()),
        'ward_id' => Arr::random(getWards()),
        'street' => $faker->streetAddress

    ];
});
