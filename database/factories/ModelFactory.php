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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Carbon\Carbon;

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {

    $date = Carbon::now()->addDays(random_int(-30, -1))->addHours(random_int(0, 23))->addMinutes(random_int(0, 59));

    $upload_path = config('app.avatar_upload_path');

    $avatar = $faker->image(public_path($upload_path), 200, 200, 'people', false);

    $is_verified = random_int(0, 1);

    if ($is_verified) {
        $is_activated = random_int(0, 1);
    } else {
        $is_activated = 0;
    }

    return [
        'created_at'   => $date,
        'updated_at'   => $date,
        'email'        => $faker->unique()->safeEmail,
        'verified'     => $is_verified,
        'subscribed'   => $is_verified,
        'activated'    => $is_activated,
        'activated_at' => function () use ($is_activated, $date) {
            return ($is_activated) ? $date->addHour() : null;
        },
        'access_token' => str_random(30),
        'rating'       => random_int(1, 1000),
        'first_name'   => $faker->firstName(),
        'last_name'    => $faker->lastName(),
        'country'      => $faker->countryCode(),
        'video_url'    => str_random(11),
        'avatar'       => $avatar,
        'about'        => $faker->paragraph(),
        //        'fb_like'   => true,
        //        'fb_share'  => true,
        //        'fb_id'   => $faker->randomNumber(12),
        //        'fb_email'   => $faker->unique()->safeEmail,
        //        'fb_name'   => $faker->name,
    ];
});


