<?php

use App\Services\Utilities\Day;
use Faker\Generator as Faker;

$factory->define(App\WorkingDay::class, function (Faker $faker) {
    return [
        'index' => Day::names(),
        'name' => Day::values(),
    ];
});
