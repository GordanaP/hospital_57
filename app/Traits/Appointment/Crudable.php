<?php

namespace App\Traits\Appointment;

use App\Doctor;
use App\Patient;

trait Crudable
{
    /**
     * Create a new appointment.
     *
     * @param  \App\Doctor $doctor
     * @return \App\Appointment
     */
    public static function createNew($doctor)
    {
        $patient = Patient::requestAppointment($doctor);

        $appointment = (new static)
            ->addDoctor($doctor)
            ->addPatient($patient)
            ->save();

        return $appointment;
    }

    /**
     * Update the appointment.
     *
     * @return \App\Appointment
     */
    public function saveChanges()
    {
        tap($this->patient)->update([
            'phone' => request('phone')
        ]);

        $doctor = Doctor::find(request('doctor_id'));

        return $this->addDoctor($doctor)->save();
    }

    /**
     * Associate the appointment with the patient.
     *
     * @param \App\Patient $patient
     */
    public function addPatient($patient)
    {
        return $this->patient()->associate($patient);
    }

    /**
     * Associate the appointment with the doctor.
     *
     * @param \App\Doctor $doctor
     */
    public function addDoctor($doctor)
    {
        return $this->doctor()->associate($doctor);
    }
}