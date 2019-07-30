<?php

use Faker\Generator as Faker;

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

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
    	'rut' => "{$faker->numberBetween(1, 80)}.{$faker->numberBetween(100, 999)}.{$faker->numberBetween(100, 999)}-{$faker->numberBetween(1, 9)}",
        'full_name' => $faker->name . ' ' . $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('123456'),
        'profile_picture' => '/uploads/users/avatar.png',
        'role_id' => 1,
        'remember_token' => str_random(10)
    ];
});
