<?php

namespace App\Traits\User;

use App\Doctor;

trait Crudable
{
    /**
     * Create a new user.
     *
     * @param  array $data
     * @return \App\User
     */
    public static function createNew($attributes)
    {
        $user = static::create($attributes);

        $user->addDoctor(request('doctor_id'));

        return $user;
    }

    /**
     * Update the user.
     *
     * @return void
     */
    public function saveChanges($attributes)
    {
        $this->hasDoctor() && $this->doctor->id !== request('doctor_id')
            ? $this->doctor->detachUser() : '';

        $doctor = Doctor::find(request('doctor_id'));

        $this->update($attributes);

        $this->addDoctor($doctor);
    }
}