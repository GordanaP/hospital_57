<?php

namespace App\Traits\User;

use App\Doctor;

trait Crudable
{
    /**
     * Create a new user.
     *
     * @param  array $attributes
     * @return \App\User
     */
    public static function createNew(array $attributes)
    {
        $userAttributes = static::getUserAttributes($attributes);

        $user = tap(static::create($userAttributes))
            ->addDoctor(request('doctor_id'));

        return $user;
    }

    /**
     * Update the user.
     *
     * @param  array $attributes
     * @return void
     */
    public function saveChanges(array $attributes)
    {
        $this->hasDoctor() && $this->doctor->id !== request('doctor_id')
            ? $this->doctor->detachUser() : '';

        tap($this)
            ->update($attributes)
            ->addDoctor(request('doctor_id'));
    }

    /**
     * Determine if the user has the doctor.
     *
     * @return boolean
     */
    public function hasDoctor()
    {
        return $this->doctor;
    }

    /**
     * Add doctor to a user.
     *
     * @param integer $id
     */
    public function addDoctor($id)
    {
        $doctor = Doctor::find($id);

        return $doctor ? $this->doctor()->save($doctor) : '';
    }


    /**
     * Get the password.
     *
     * @param  array  $attributes
     * @return string
     */
    public static function getPassword(array $attributes)
    {
        $userAttributes = static::getUserAttributes($attributes);

        return array_key_exists("password", $userAttributes)
            ? $userAttributes['password'] : '';
    }

    /**
     * Get user attributes.
     *
     * @param  array  $attributes
     * @return array
     */
    public static function getUserAttributes(array $attributes)
    {
        if (request('handle-password') == 'auto') {

            $attributes['password'] = str_random(6);
        }
        else if (request('handle-password') == 'manual') {

            $attributes['password'] = request('password');
        }

        return $attributes;
    }
}
