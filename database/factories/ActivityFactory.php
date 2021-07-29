<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Activity;
use Faker\Generator as Faker;

$factory->define(Activity::class, function (Faker $faker) {
    $title=['Make a Drawing',
        'Write a New Ending',
        'Make a Collage',
        'Summarize the Story',
        'Appreciate the Illustrations',
        'Build Your Vocabulary',
        'Mess the Sequence',
        'Discuss the Plot',
        'Action and Consequence',
        'Write to the Author'];

    return [
        'title'         => $title[rand(0,9)],
        'description'   => $faker->sentence($nbWords = 20, $variableNbWords = true),
        'created_at'    => now(),
        'updated_at'    => now()
    ];
});
