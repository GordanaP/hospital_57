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
    public static function createNew(array $attributes)
    {
        $doctorAttributes = static::getDoctorAttributes($attributes);

        $doctor = tap(static::create($doctorAttributes))
            ->addUser(request('user_id'));

        return $doctor;
    }

    /**
     * Update the doctor.
     *
     * @param  array $attributes
     * @return void
     */
    public function saveChanges(array $attributes)
    {
        $this->image->removeOld($this->image);

        $this->update(static::getDoctorAttributes($attributes));
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

    /**
     * Get the doctor's attributes.
     *
     * @param  array $attributes
     * @return array
     */
    public static function getDoctorAttributes(array $attributes)
    {
        request('image') ? $attributes['image'] = request('image')->store('doctors', 'public') : '';

        request('deleteImage') ? $attributes['image'] = NULL : '';

        return $attributes;
    }
}