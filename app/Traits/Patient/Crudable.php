<?php

namespace App\Traits\Patient;

trait Crudable
{
    /**
     * Create a new patient.
     *
     * @param  array $attributes
     * @return \App\Patient
     */
    public static function createNew($attributes)
    {
        $patient = tap(static::create($attributes))
            ->addDoctor(request('doctor_id'));

        return $patient;
    }

    /**
     * Update the patient.
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
     * Identify the patient who requests an appointment.
     *
     * @param  \App\Doctor $doctor
     * @return \App\Patient
     */
    public static function requestAppointment($doctor)
    {
        $patient = static::updateOrCreate(
            request()->only('first_name', 'last_name', 'birthday'),
            request()->only('phone')
        );

        ! $patient->hasDoctor() ? $patient->addDoctor($doctor->id) : '';

        return $patient;
    }
}