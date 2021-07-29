<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    $title=['Ginger the Giraffe',
        'Freddie and the Fairy',
        'Tomorrow Most Likely',
        'Sam and Pam',
        'The Happy Book',
        'The Good Egg',
        'Bloom',
        'Chicken Cheeks',
        'The Cat in the Hat',
        'The Great Indoors'];

    return [
        'user_id'           => $faker->numberBetween($min = 1, $max = 50),
        'title'             => $title[rand(0,9)],
        'description'       => $faker->sentence($nbWords = 20, $variableNbWords = true),
        'cover_url'         => 'cover_'.$faker->numberBetween($min = 1, $max = 10).'.jpg',
        'read_time'         => $faker->numberBetween($min = 1, $max = 120),
        'age_group_id'      => $faker->numberBetween($min = 1, $max = 7),
        'is_active'         => $faker->numberBetween($min = 0, $max = 1),
        'access_level'      => $faker->numberBetween($min = 0, $max = 1),
        'created_at'        => now(),
        'updated_at'        => now()
    ];
});
