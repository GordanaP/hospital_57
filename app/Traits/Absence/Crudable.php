<?php

namespace App\Traits\Absence;

use App\Doctor;

trait Crudable
{
    /**
     * Create a new absence.
     *
     * @param  array $attributes
     * @return \App\Absence
     */
    public static function createNew($attributes)
    {
        $absence = (new static($attributes))->addDoctor(request('doctor_id'));

        return $absence;
    }

    /**
     * Update an absence.
     *
     * @param  array $attributes
     * @return void
     */
    public function saveChanges($attributes)
    {
        tap($this)->update($attributes)
            ->addDoctor(request('doctor_id'));
    }

    /**
     * Associate a doctor with an absence.
     *
     * @param \App\Doctor $doctor
     *
     */
    public function addDoctor($id)
    {
        $doctor = Doctor::find($id);

        return $doctor ? $this->doctor()->associate($doctor)->save() : '';
    }
}