<?php

namespace App\Traits\Patient;

use App\Doctor;

trait HasDoctor
{
    /**
     * Determine if the patient has a doctor.
     *
     * @return boolean
     */
    public function hasDoctor()
    {
        return $this->doctor;
    }

    /**
     * Add a doctor to a patient.
     *
     * @param integer $id
     * @return void
     */
    public function addDoctor($id)
    {
        $doctor = Doctor::find($id);

        $doctor ? $this->doctor()->associate($doctor)->save() : $this->detachDoctor();
    }

    /**
     * Detach doctor from the patient.
     *
     * @return void
     */
    public function detachDoctor()
    {
        $this->doctor()->dissociate()->save();
    }
}