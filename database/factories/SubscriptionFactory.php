<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Subscription;
use Faker\Generator as Faker;

$factory->define(Subscription::class, function (Faker $faker) {
    return [
        'user_id'       => $faker->numberBetween($min = 1, $max = 100),
        'plan_id'       => $faker->numberBetween($min = 1, $max = 10),
        'start_date'    => $faker->date($format = 'Y-m-d',$min = '2021-01-01', $max = '2021-03-26'),
        'end_date'      => $faker->date($format = 'Y-m-d',$min = '2021-03-27', $max = '2030-12-31'),
        'created_at'    => now(),
        'updated_at'    => now()
    ];
});
