<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'user_type_id'          => 2,
        'first_name'            => $faker->firstNameMale,
        'last_name'             => $faker->lastName,
        'user_name'             => $faker->unique()->userName,
        'email'                 => $faker->unique()->safeEmail,
        'email_verified_at'     => now(),
        'password'              => Hash::make('123456'),
        'user_photo_url'        => 'user_'.$faker->numberBetween($min = 1, $max = 10).'.jpg',
        'remember_token'        => Str::random(10),
    ];
});
