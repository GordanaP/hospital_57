<?php

use App\Services\Utilities\Color;
use Faker\Generator as Faker;

$factory->define(App\LeaveType::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'color' => array_random(Color::names()),
    ];
});
