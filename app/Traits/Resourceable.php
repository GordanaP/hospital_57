<?php

namespace App\Traits;

use App\Doctor;
use App\Http\Resources\DoctorResource;
use App\Http\Resources\PatientResource;
use App\Http\Resources\UserResource;
use App\Patient;
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

    /**
     * Get the patient collection.
     *
     * @param  \App\Doctor $doctor
     * @return Illuminate\Support\Collection
     */
    public function patientsResourceCollection($doctor)
    {
        $patients = $this->selectPatients($doctor);

        return PatientResource::collection($patients);
    }

    /**
     * Select a doctor's patients.
     *
     * @param  \App\Doctor | null $doctor
     * @return Illuminate\Support\Collection
     */
    private function selectPatients($doctor = null)
    {
        return optional($doctor)->patients ?: Patient::all();
    }

}
