<?php

namespace App\Traits\Doctor;

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
}