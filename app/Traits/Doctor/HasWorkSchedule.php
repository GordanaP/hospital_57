<?php

namespace App\Traits\Doctor;

use App\Services\CustomClasses\AppCarbon;

trait HasWorkSchedule
{
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

    /**
     * Present the doctor's work day or time.
     *
     * @param  integer $i
     * @param  string  $value | null
     * @return mixed
     */
    public function presentScheduledValue($i, $value = null)
    {
        for ($k=0; $k < sizeof($this->working_days); $k++) {

            if ($k == $i) {

                return $value ? $this->working_days[$k]->hour->$value
                              : $this->working_days[$k]->id;
            }
        }
    }

    /**
     * Save the doctor's work schedule.
     *
     * @param array $days
     * @return void
     */
    public function addWorkSchedule($days)
    {
        $schedule = static::makeWorkSchedule($days);

        $this->hasWorkSchedule() ? $this->working_days()->sync($schedule)
                             : $this->working_days()->attach($schedule);
    }

    /**
     * Delete the doctor's work schedule.
     *
     * @return void
     */
    public function deleteWorkSchedule()
    {
        $this->working_days()->detach();
    }

    /**
     * Make a schedule.
     *
     * @param  array $days
     * @return Illuminate\Support\Collection
     */
    protected static function makeWorkSchedule($days)
    {
        // Get a collection
        $schedule = collect($days)

        // Exclude "day_id == null"
        ->reject(function ($day) {
            return empty($day['day_id'] !== null);
        })

        // Group by 'day_id'
        ->keyBy(function ($day) {

            return $day['day_id'];
        })

        // Transform to exclude 'day_id'
        ->transform(function ($value, $key) {

            return collect($value)->forget('day_id');
        });

        return $schedule;
    }

    /**
     * Get time slots on a specific working day.
     *
     * @param  string $date
     * @return array
     */
    public function getTimeSlotsOnWorkDay($date)
    {
        $workingDay = $this->getWorkDay($date);

        $start = $workingDay->hour->start_at;
        $end = $workingDay->hour->end_at;

        return AppCarbon::slotTimes($start, $end, $this->app_slot);
    }

    /**
     * Determine if the doctor is working on a specific date.
     *
     * @param  string  $date
     * @return boolean
     */
    public function isWorkingOnDate($date)
    {
        return $this->getWorkDay($date);
    }

    /**
     * Get the doctor's working day.
     *
     * @param  string $date
     * @return \App\WorkingDay
     */
    public function getWorkDay($date)
    {
        $dateDay = AppCarbon::isValidDate($date)
            ? AppCarbon::parse($date)->dayOfWeekIso : '';

        return $workingDay = $this->working_days->find($dateDay);
    }

    /**
     * Determine if the doctor is absent from work on a specific date.
     *
     * @param  string  $date
     * @return boolean
     */
    public function isAbsentFromWorkOnDate($date)
    {
        return $this->absences
            ->where('start_at', '<=', $date)
            ->where('end_at', '>=' , $date)
            ->isNotEmpty();
    }

    /**
     * Determine if the doctor is working on a specific date and hour.
     *
     * @param  string  $date
     * @param  string  $time
     * @return boolean
     */
    public function isWorkingOnDateHour($date, $time)
    {
        $wday = $this->getWorkDay($date);

        return $wday ? $time >= $wday->hour->start_at && $time < $wday->hour->end_at
                     : '';
    }

    /**
     * Determine if the doctor has no appointment on a specific date and time.
     *
     * @param  string  $date
     * @param  string  $time
     * @return boolean
     */
    public function hasNoAppointmentOnDateTime($date, $time)
    {
        $start_at = AppCarbon::createDate($date . $time);

        return ! $this->appointments->firstWhere('start_at', $start_at);
    }
}