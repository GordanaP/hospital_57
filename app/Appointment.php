<?php

namespace App;

use App\Patient;
use App\Services\CustomClasses\AppCarbon;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['start_at', 'doctor_id', 'patient_id'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['start_at'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['end_at'];

    /**
     * Get the doctor that has the given appointment.
     *
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    /**
     * Get the patient that has the given appointment.
     *
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Get the appointment end time.
     *
     * @return \Carbon\Carbon
     */
    public function getEndAtAttribute()
    {
        return $this->start_at->addMinutes($this->doctor->app_slot)->toDateTimeString();
    }

    public function addPatient($patient)
    {
        return $this->patient()->associate($patient);
    }

    public function addDoctor($doctor)
    {
        return $this->doctor()->associate($doctor);
    }

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
}
