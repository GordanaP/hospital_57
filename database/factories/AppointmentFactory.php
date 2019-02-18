<?php

use App\Doctor;
use App\Patient;
use Faker\Generator as Faker;
use Illuminate\Support\Carbon;

$factory->define(App\Appointment::class, function (Faker $faker) {
    return [
        'doctor_id' => Doctor::inRandomOrder()->first()->id,
        'patient_id' => Patient::inRandomOrder()->first()->id,
    ];
});
