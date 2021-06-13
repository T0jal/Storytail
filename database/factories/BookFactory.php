<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'user_id'           => $faker->numberBetween($min = 1, $max = 100),
        'title'             => $faker->company,
        'description'       => $faker->sentence($nbWords = 20, $variableNbWords = true),
        'cover_url'         => $faker->numberBetween($min = 1, $max = 10).'.jpg',
        'read_time'         => $faker->numberBetween($min = 1, $max = 120),
        'age_group_id'      => $faker->numberBetween($min = 1, $max = 7),
        'is_active'         => $faker->numberBetween($min = 0, $max = 1),
        'access_level'      => $faker->numberBetween($min = 0, $max = 1),
        'created_at'        => now(),
        'updated_at'        => now()
    ];
});
