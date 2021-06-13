<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Video;
use Faker\Generator as Faker;

$factory->define(Video::class, function (Faker $faker) {
    return [
        'book_id'           => $faker->numberBetween($min = 1, $max = 50),
        'title'             => $faker->sentence($nbWords = 5, $variableNbWords = false),
        'video_url'         => "https://www.youtube.com/embed/JfJYHfrOGgQ",
        'created_at'        => now(),
        'updated_at'        => now()
    ];
});
