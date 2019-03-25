<?php

use Faker\Generator as Faker;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

$factory->define(App\Models\Product::class, function (Faker $faker) {
    return [
        'cat_id' => Arr::random([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17]),
        'name' => $faker->name,
        'sku' => Str::random(8),
        'barcode' => Str::random(8),
        'alias' => Str::slug($faker->name),
        'discount_id' => Arr::random([1,2,3]),
        'img_link' => Str::random(40),
        'img_list' => Str::random(40),
        'view' => 5 * Arr::random([1,2,3,4,5,6,7,8,9]),
        'short_description' => Str::random(64),
        'description' => Str::random(255),
        'status' => Arr::random([1, 2, 3])
    ];
});
