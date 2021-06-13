<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Plan;
use Faker\Generator as Faker;

$factory->define(Plan::class, function (Faker $faker) {
    return [
        'name'                  => $faker->state,
        'price'                 => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 1000),
        'duration'              => $faker->numberBetween($min = 1, $max = 365),
        'access_level'          => $faker->numberBetween($min = 0, $max = 1),
        'created_at'            => now(),
        'updated_at'            => now()
    ];
});
