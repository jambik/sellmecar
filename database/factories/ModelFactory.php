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
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Car::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company,
        'image' => $faker->image()
    ];
});

$factory->define(App\News::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
        'text' => $faker->paragraphs(),
        'published_at' => $faker->dateTimeBetween('-10 days', 'now')
    ];
});

$factory->define(App\Metro::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'metro_line' => $faker->numberBetween(0, 12),
        'city' => $faker->city,
    ];
});