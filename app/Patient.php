<?php

namespace App;

use App\Traits\Patient\Crudable;
use App\Traits\Patient\HasDoctor;
use App\Traits\Patient\Presentable;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use Crudable, HasDoctor, Presentable;

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
     * Get the doctor's appointments.
     *
     * @return  \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
