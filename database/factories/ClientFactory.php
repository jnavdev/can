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

$factory->define(App\Client::class, function (Faker $faker) {
    return [
    	'rut' => "{$faker->numberBetween(1, 80)}.{$faker->numberBetween(100, 999)}.{$faker->numberBetween(100, 999)}-{$faker->numberBetween(1, 9)}",
        'full_name' => $faker->name . ' ' . $faker->lastName,
        'address' => $faker->streetAddress,
        'activity' => $faker->sentence,
        'observation' => $faker->sentence,
        'payment_method_id' => 1
    ];
});
