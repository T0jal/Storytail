<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
//Hello
use App\ActivityBook;
use Faker\Generator as Faker;

$factory->define(ActivityBook::class, function (Faker $faker) {
    return [
        'book_id'       => $faker->numberBetween($min = 1, $max = 50),
        'activity_id'   => $faker->numberBetween($min = 1, $max = 10),
        'created_at'    => now(),
        'updated_at'    => now()
    ];
});
