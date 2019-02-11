<?php

namespace App\Traits\Doctor;

use App\User;

trait Crudable
{
    /**
     * Create a new doctor.
     *
     * @param  array $data
     * @return \App\Doctor
     */
    public static function createNew($attributes)
    {
        $doctor = static::create($attributes);

        $user = User::find(request('user_id'));

        optional($user)->addDoctor($doctor);

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