<?php

namespace App;

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

}
