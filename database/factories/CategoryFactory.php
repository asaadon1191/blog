<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return 
    [
        'name'      => $faker->word,
        'active'    => $faker->numberBetween($min = 0, $max = 1),
        'photo'     => 'category/i5LoixcYUJGckapAQiArQBQFgGPWmhLut8VenVhU.jpeg',
    ];
});
