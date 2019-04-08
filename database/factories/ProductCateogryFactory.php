<?php

use Faker\Generator as Faker;

$factory->define(App\Models\ProductCategory::class, function (Faker $faker) {
    return [
        'category_id' => $faker->numberBetween(1,10),
        'product_id' => $faker->numberBetween(1,10),
        'pivot' => $faker->name
    ];
});
