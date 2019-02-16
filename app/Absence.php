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
        $absence = (new static($attributes))->addDoctor(request('doctor_id'));

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
        tap($this)
            ->update($attributes)
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
