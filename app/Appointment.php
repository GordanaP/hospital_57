<?php

namespace App;

use App\Services\CustomClasses\AppCarbon;
use App\Traits\Appointment\Crudable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Appointment extends Model
{
    use Crudable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['start_at'];

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

}
