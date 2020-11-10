<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return 
    [
        'name'          => $faker->word(2),
        'desc'          => $faker->text,
        'price'         => $faker->numberBetween($min = 100, $max = 50000),
        'category_id'   => $faker->numberBetween($min = 7, $max = 17),
        'active'        => $faker->numberBetween($min = 0, $max = 1),
    ];
});
