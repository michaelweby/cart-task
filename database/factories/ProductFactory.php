<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name'=>$faker->name,
        'price'=>$faker->numberBetween(10,2000)
    ];
});
