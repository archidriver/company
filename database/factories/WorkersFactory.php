<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Workers;
use Faker\Generator as Faker;
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
//
$factory->define(\App\Workers::class, function (Faker $faker) {
    $faker = \Faker\Factory::create('Ru_RU');
    $filepath = storage_path('avatars');


    return [
        'name' => $faker->name,
         'position_id' => $faker->jobTitle,
         'date_start' => $faker->date($format = 'Y-m-d', $max = 'now'),
         'salary' => $faker->numberBetween($min = 300, $max = 10000),
         'level' => rand(1, 5),
        'image' => $faker->imageUrl(50,50, null, true),//image('public/storage/images',25,25, null, true),
//
    ];
});


