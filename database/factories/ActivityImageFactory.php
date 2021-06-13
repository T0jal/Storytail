<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ActivityImage;
use Faker\Generator as Faker;

$factory->define(ActivityImage::class, function (Faker $faker) {
    return [
        'activity_id'   => $faker->numberBetween($min = 1, $max = 10),
        'title'         => $faker->sentence($nbWords = 5, $variableNbWords = false),
        'image_url'     => $faker->numberBetween($min = 1, $max = 10).'.jpg'
    ];
});
