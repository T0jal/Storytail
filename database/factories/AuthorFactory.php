<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Author;
use Faker\Generator as Faker;

$factory->define(Author::class, function (Faker $faker) {
    return [
        'first_name'            => $faker->firstNameMale,
        'last_name'             => $faker->lastName,
        'description'           => $faker->sentence($nbWords = 20, $variableNbWords = true),
        'author_photo_url'      => 'author_'.$faker->numberBetween($min = 1, $max = 10).'.jpg',
        'nationality'           => $faker->country,
        'created_at'            => now(),
        'updated_at'            => now()
    ];
});
