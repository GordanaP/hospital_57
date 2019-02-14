<?php

use App\Doctor;
use Faker\Generator as Faker;
use Illuminate\Support\Carbon;

$factory->define(App\Absence::class, function (Faker $faker) {
    return [
        'doctor_id' => Doctor::inRandomOrder()->first()->id,
        'start_at' => Carbon::tomorrow(),
        'end_at' => Carbon::tomorrow()->addDays(10)
    ];
});
