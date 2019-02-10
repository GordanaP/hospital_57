<?php

use App\Doctor;
use Faker\Generator as Faker;

$factory->define(App\Patient::class, function (Faker $faker) {
    return [
        'doctor_id' => Doctor::inRandomOrder()->first()->id,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'gender' => array_random(['M', 'F']),
        'birthday' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'postal_code' => $faker->postcode,
        'city' => $faker->city,
        'address' => $faker->streetAddress,
        'phone' => $faker->phoneNumber,
    ];
});
