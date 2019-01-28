<?php

use App\Services\Utilities\Color;
use App\Services\Utilities\Specialty;
use App\Services\Utilities\Title;
use App\User;
use Faker\Generator as Faker;

$factory->define(App\Doctor::class, function (Faker $faker) {
    return [
        'user_id' => User::inRandomOrder()->first()->id,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'title' => array_random(Title::names()),
        'specialty' => array_random(Specialty::names()),
        'license' => rand(100000, 999999),
        'biography' => $faker->paragraph,
        'color' => array_random(Color::names()),
    ];
});
