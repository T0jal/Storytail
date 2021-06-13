<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Page;
use Faker\Generator as Faker;

$factory->define(Page::class, function (Faker $faker) {
    return [
        'book_id'           => $faker->numberBetween($min = 1, $max = 50),
        'page_image_url'    => $faker->numberBetween($min = 1, $max = 10).'.jpg',
        'audio_url'         => $faker->url,
        'page_index'        => $faker->numberBetween($min = 1, $max = 5),
        'created_at'        => now(),
        'updated_at'        => now()
    ];
});
