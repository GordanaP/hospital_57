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
     * @param  array $data
     * @return \App\Absence
     */
    public static function createNew($attributes)
    {
        $absence = new static($attributes);

        $doctor = Doctor::find(request('doctor_id'));

        $doctor->addAbsence($absence);

        return $absence;
    }

}
