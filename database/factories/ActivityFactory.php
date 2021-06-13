<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Activity;
use Faker\Generator as Faker;

$factory->define(Activity::class, function (Faker $faker) {
    return [
        'title'         => $faker->company,
        'description'   => $faker->sentence($nbWords = 20, $variableNbWords = true),
        'created_at'    => now(),
        'updated_at'    => now()
    ];
});
