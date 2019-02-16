<?php

namespace App\Traits\Doctor;

use App\User;

trait Crudable
{
    /**
     * Create a new doctor.
     *
     * @param  array $attributes
     * @return \App\Doctor
     */
    public static function createNew($attributes)
    {
        $doctor = tap(static::create($attributes))
            ->addUser(request('user_id'));

        return $doctor;
    }

    /**
     * Delete the doctor.
     *
     * @return void
     */
    public function remove()
    {
        $this->image->removeFromStorage($this->image);

        optional($this->user)->delete();

        $this->delete();
    }
}