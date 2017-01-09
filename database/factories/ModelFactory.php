<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/


$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
    ];
});

$factory->define(App\Models\Comment::class, function (Faker\Generator $faker) {
    $max_id = App\Models\User::max('id');
    return [
        'user_id' => random_int(1, $max_id),
        'comment' => $faker->realText(100),
        'rating' => random_int(1, 5),
    ];
});