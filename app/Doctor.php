<?php

namespace App;

use App\Services\CustomClasses\AppCarbon;
use App\Traits\Doctor\Crudable;
use App\Traits\Doctor\HasAppointment;
use App\Traits\Doctor\HasAttributes;
use App\Traits\Doctor\HasUser;
use App\Traits\Doctor\HasWorkSchedule;
use App\Traits\Doctor\Presentable;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasAppointment, HasAttributes, HasUser, Crudable, Presentable, HasWorkSchedule;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'title', 'specialty', 'license', 'biography',
        'color', 'app_slot', 'image'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['title_last_name'];

    /**
     * Get the doctor's user account.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the doctor's patients.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function patients()
    {
        return $this->hasMany(Patient::class);
    }

    /**
     * Get the doctor's working days.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function working_days()
    {
        return $this->belongsToMany(WorkingDay::class)
            ->as('hour')
            ->withPivot('start_at', 'end_at');
    }

    /**
     * Get the doctor's absences.
     *
     * @return  \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function absences()
    {
        return $this->hasMany(Absence::class);
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

    /**
     * Get doctors without user account.
     *
     * @param \App\User | null $user
     * @return Illuminate\Support\Collection
     */
    public static function hasNoAccountCollection($user = null)
    {
        $available_doctors = static::doesnthave('user')->get();

        optional($user)->doctor ? $available_doctors->push($user->doctor) : '';

        return $available_doctors;
    }

    /**
     * Determine if the doctor has patients.
     *
     * @return boolean
     */
    public static function hasPatients()
    {
        return $this->patients->count();
    }

    /**
     * Determine if the doctor has absences.
     *
     * @return boolean
     */
    public function hasAbsences()
    {
        return $this->absences->count();
    }

    /**
     * Determine if the doctor has appointments.
     *
     * @return boolean
     */
    public function hasAppointments()
    {
        return $this->appointments->count();
    }


}
