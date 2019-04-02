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
use Illuminate\Support\Collection;

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
     * Get the doctor's leave types.
     *
     * @return  \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function leave_types()
    {
        return $this->belongsToMany(LeaveType::class)
            // ->as('days_count')
            ->withPivot('year', 'total');
    }

    public function annualLeaves($year)
    {
        return $this->belongsToMany(LeaveType::class)
            ->wherePivot('year', $year);
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

    /**
     * Determine if the doctor is not away from work in a specific period.
     *
     * @param  string  $from
     * @param  string  $to
     * @return boolean
     */
    public function isNotAwayFromWork($from, $to)
    {
        $newAbsence = AppCarbon::getDatesRange($from, $to);

        $currentAbsences = $this->absences->transform(function ($absence, $key) {

            return AppCarbon::getDatesRange($absence->start_at, $absence->end_at);

        })->flatten();

        return $currentAbsences->intersect($newAbsence)->isEmpty();
    }

    /**
     * Get overlapping absences.
     *
     * @param  string $from
     * @param  string $to
     * @return \Illuminate\Support\Collection
     */
    public function ignoreEditableAbsence($from, $to, $absenceId)
    {
        $newRange = AppCarbon::getDatesRange($from, $to);

        $overlapped = $this->absences->transform(function ($absence, $key)
            use($newRange) {

            $dateRanges = AppCarbon::getDatesRange($absence->start_at, $absence->end_at);

            return $dateRanges->intersect($newRange)->isNotEmpty() ? collect($absence->id) : '';
        })->flatten()->filter();

        return $overlapped->isEmpty()
               || ($overlapped->count() == 1 && $overlapped->contains($absenceId));
    }

    /**
     * Filter absences by year.
     *
     * @param  string $year
     * @return Illuminate\Support\Collection
     */
    public function filterAbsences($year)
    {
        $filteredByYear = ($this->absences)->groupBy(function ($absence) {
                return \Carbon\Carbon::parse($absence->start_at)->format('Y');
        })
        ->filter(function($value, $currentYear) use ($year) {
            return $currentYear == $year;
        });

        return $filteredByYear;
    }

    /**
     * Annual leave allowed.
     *
     * @param  integer $year
     * @return integer
     */
    public function getAnnualLeaveAllowed($year)
    {
        return $this->leave_types()->wherePivot('year', $year)
            ->first()->pivot->total;
    }

    /**
     * Annual leave allowed.
     *
     * @param  integer $year
     * @return integer
     */
    public function getPreviousYearAnnualLeaveAllowed($year)
    {
        return $this->leave_types()->wherePivot('year', $year-1)
            ->first()->pivot->total;
    }
}
