<?php

use Faker\Generator as Faker;

$factory->define(App\Models\ProductItem::class, function (Faker $faker) {
    return [
        'sku_item' => $faker->word,
        'product_id' => $faker->numberBetween(1,150),
        'quantity' => $faker->numberBetween(1,10),
        'price'=> 15000 * $faker->numberBetween(1,30),
        'iprice'=> 10000 * $faker->numberBetween(1,30),
        'discount_id'=> $faker->randomElement([1,2]),
        'length' => $faker->numberBetween(20,100),
        'height' => $faker->numberBetween(20,1000),
        'weight' => $faker->numberBetween(200,10000),
        'width' => $faker->numberBetween(20,100),
        'color' => $faker->randomElement(['red','green','yellow','black','blue','gray']),
        'size' => $faker->randomElement(['M','S','XL','XXL','L','31','32','27','28','29','30']),
    ];
});
