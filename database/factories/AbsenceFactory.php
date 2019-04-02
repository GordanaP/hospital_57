<?php

use App\Doctor;
use App\LeaveType;
use Faker\Generator as Faker;
use Illuminate\Support\Carbon;

$factory->define(App\Absence::class, function (Faker $faker) {
    return [
        'doctor_id' => Doctor::inRandomOrder()->first()->id,
        'leave_type_id' => LeaveType::inRandomOrder()->first()->id,
        'start_at' => Carbon::tomorrow(),
        'end_at' => Carbon::tomorrow()->addDays(5)
    ];
});
