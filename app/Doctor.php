<?php

namespace App;

use App\Traits\Doctor\HasAttributes;
use App\Traits\Doctor\HasUser;
use App\Traits\Doctor\Crudable;
use App\Traits\Doctor\Presentable;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasAttributes, HasUser, Crudable, Presentable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'title', 'specialty', 'license', 'biography', 'color', 'app_slot', 'image'
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
     * Determine if the doctor has a work schedule.
     *
     * @return boolean
     */
    public function hasWorkSchedule()
    {
        return $this->working_days->count();
    }

    /**
     * Get the doctor's workdays.
     *
     * @return Illuminate\Support\Collection
     */
    public function workDays()
    {
        return $this->working_days->pluck('index');
    }

    /**
     * Determine if the doctor is working on a specific day.
     *
     * @param  integer  $day
     * @return boolean
     */
    public function isWorkingOnDay($day)
    {
        return $this->workDays()->contains($day);
    }
}
