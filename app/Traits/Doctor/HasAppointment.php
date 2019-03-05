<?php

namespace App\Traits\Doctor;

use App\Services\CustomClasses\AppCarbon;

trait HasAppointment
{
    /**
     * Add the appointment to the doctor.
     *
     * @param \App\Appointment $appointment
     * @return void
     */
    public function addAppointment($appointment)
    {
        $this->appointments()->save($appointment);
    }

    /**
     * Get doctor's appointments on a specific date.
     *
     * @param  string $date
     * @return Illuminate\Support\Collection
     */
    public function getAppointments($date)
    {
        $appSlots = $this->appointments->pluck('start_at');

        $apps = $appSlots->reject(function ($value, $key) use($date) {
            return AppCarbon::formatDate($value) !== $date;
        });

        return $apps;
    }

    /**
     * Get doctor's booked slots on a cpecific date.
     *
     * @param  string $date
     * @return array
     */
    public function getBookedSlots($date)
    {
        $appointments = $this->getAppointments($date);

        $bookedSlots = [];

        foreach ($appointments as $appointment) {

            $bookedSlot = $this->createBookedSlot($appointment);

            array_push($bookedSlots, $bookedSlot);
        }

        return $bookedSlots;
    }

    /**
     * The work start hour on a specific date.
     *
     * @param  string $date
     * @return string
     */
    public function startsWork($date)
    {
        return $this->getWorkDay($date)->hour->start_at;
    }

    /**
     * The work end hour on a specific date.
     *
     * @param  string $date
     * @return string
     */
    public function endsWork($date)
    {
        return $this->getWorkDay($date)->hour->end_at;
    }

    /**
     * Create a booked slot.
     *
     * @param  string $appointment
     * @return array
     */
    private function createBookedSlot($appointment)
    {
        return [
            'start' => AppCarbon::formatDate($appointment, 'H:i'),
            'end' => AppCarbon::formatDate($appointment->addMinutes($this->app_slot), 'H:i')
        ];

    }
}