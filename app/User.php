<?php

namespace App;

use App\Doctor;
use App\Traits\User\Crudable;
use App\Traits\User\Presentable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Crudable, Notifiable, Presentable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the doctor profile associated with the given user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }

    /**
     * Determine if the user has the doctor.
     *
     * @return boolean
     */
    public function hasDoctor()
    {
        return $this->doctor;
    }

    /**
     * Add doctor to a user.
     *
     * @param \App\Doctor $doctor
     */
    public function addDoctor($id)
    {
        $doctor = Doctor::find($id);

        return $doctor ? $this->doctor()->save($doctor) : '';
    }
}
