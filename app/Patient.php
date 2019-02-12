<?php

namespace App;

use App\Doctor;
use App\Traits\Patient\Presentable;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use Presentable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'gender', 'birthday', 'address',
        'postal_code', 'city', 'phone'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['full_name'];

    /**
     * Get the doctor the patient belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

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
     * @param \App\Doctor $doctor
     * @return void
     */
    public function addDoctor($doctor)
    {
        $this->doctor()->associate($doctor)->save();
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

    /**
     * Create a new patient.
     *
     * @param  array $attributes
     * @return \App\Patient
     */
    public static function createNew($attributes)
    {
        $patient = static::create($attributes);

        $doctor = Doctor::find(request('doctor_id'));

        $patient->addDoctor($doctor);

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
        $doctor = Doctor::find(request('doctor_id'));

        $this->addDoctor($doctor);

        $this->update($attributes);
    }

}
