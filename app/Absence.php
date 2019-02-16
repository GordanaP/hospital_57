<?php

namespace App;

use App\Doctor;
use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description', 'start_at', 'end_at'
    ];

    /**
     * Get the doctor that has the given absence.
     *
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    /**
     * Create a new absence.
     *
     * @param  array $attributes
     * @return \App\Absence
     */
    public static function createNew($attributes)
    {
        $doctor = Doctor::find(request('doctor_id'));

        $absence = (new static($attributes))->addDoctor($doctor);

        return $absence;
    }

    /**
     * Update an absence.
     *
     * @param  array $data
     * @return \App\Absence
     */
    public function saveChanges($attributes)
    {
        $this->update($attributes);

        $doctor = Doctor::find(request('doctor_id'));

        $doctor->addAbsence($this);

        return $this;
    }

    /**
     * Associate a doctor with an absence.
     *
     * @param \App\Doctor $doctor
     *
     */
    public function addDoctor($doctor)
    {
        return $this->doctor()->associate($doctor)->save();
    }

}
