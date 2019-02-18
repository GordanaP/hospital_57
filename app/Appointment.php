<?php

namespace App;

use App\Doctor;
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
        $patient = $this->patient->update([
            'phone' => request('phone')
        ]);

        $doctor = Doctor::find(request('doctor_id'));

        return $this
            ->addDoctor($doctor)
            ->addPatient($patient)
            ->save();
    }
}
