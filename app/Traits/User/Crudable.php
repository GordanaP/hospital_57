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
    public static function createNew($attributes)
    {
        $user = tap(static::create($attributes))
            ->addDoctor(request('doctor_id'));

        return $user;
    }

    /**
     * Update the user.
     *
     * @param  array $attributes
     * @return void
     */
    public function saveChanges($attributes)
    {
        $this->hasDoctor() && $this->doctor->id !== request('doctor_id')
            ? $this->doctor->detachUser() : '';

        tap($this)
            ->update($attributes)
            ->addDoctor(request('doctor_id'));
    }
}
