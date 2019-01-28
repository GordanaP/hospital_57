<?php

namespace App\Traits;

use App\Doctor;
use App\Http\Resources\DoctorResource;
use App\Http\Resources\UserResource;
use App\User;


trait Resourceable
{
    /**
     * Get the user collection.
     *
     * @return Illuminate\Support\Collection
     */
    public function usersResourceCollection()
    {
        $users = User::all();

        return UserResource::collection($users);
    }

    /**
     * Get the doctor collection.
     *
     * @return Illuminate\Support\Collection
     */
    public function doctorsResourceCollection()
    {
        $doctors = Doctor::all();

        return DoctorResource::collection($doctors);
    }
}
