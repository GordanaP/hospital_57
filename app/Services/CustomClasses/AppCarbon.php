<?php

namespace App\Services\CustomClasses;

use App\Services\CustomClasses\Holiday;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class AppCarbon extends Carbon
{
    public static function todayMorningShift($date, $start='8:00', $bp='14:00')
    {
        return $date >= static::getDateTime($date, $start)
            && $date < static::getDateTime($date, $bp);
    }

    public static function todayAfternoonShift($date, $end='20:00', $bp='14:00')
    {
        return $date >= static::getDateTime($date, $bp)
            && $date < static::getDateTime($date, $end);
    }

    public static function getDateTime($date, $hour)
    {
        return $date->setTimeFromTimeString($hour)->toDateTimeString();
    }


    public static function slotTimes($startHour, $endHour, $slotMinutes = 15, $format='H:i')
    {
        $firstSlot = self::createFromTimeString($startHour)->subMinutes($slotMinutes);

        $intervalsCount = static::intervalsCount($startHour, $endHour, $slotMinutes);

        $timeSlots = [];

        for ($i=0; $i < $intervalsCount; $i++) {
            $timeSlots[$i] = $firstSlot->addMinutes($slotMinutes)->format($format);
        }

        return $timeSlots;
    }

    public static function dayIndex($date)
    {
        return $date instanceOf Carbon ? $date->dayOfWeekIso
            : Carbon::parse($date)->dayOfWeekIso;
    }

    public static function intervalsCount($startHour, $endHour, $minutes)
    {
        $minutesTotal = static::getDifferenceInMinutes($startHour, $endHour);

        return $intervalsCount = $minutesTotal/$minutes;
    }


    private static function getDifferenceInMinutes($start, $end)
    {
        $endTime = self::createFromTimeString($end);

        $startTime = self::createFromTimeString($start);

        return $endTime->diffInMinutes($startTime);
    }

    /**
     * Format the date.
     *
     * @param  \Carbon\Carbon $date
     * @param  string $format
     * @return \Carbon\Carbon
     */
    public static function formatDate($date, $format='Y-m-d')
    {
        return $date instanceOf Carbon ? $date->format($format)
            : Carbon::parse($date)->format($format);
    }

    public static function createDate($date, $format = 'Y-m-d H:i')
    {
        return self::createFromFormat($format, $date)->toDateTimeString();
    }

    public static function isValidDate($date, $format='Y-m-d')
    {
        return date($format, strtotime($date)) == $date;
    }

    public static function isNotWeekend($date)
    {
        return self::dayIndex($date) !== 6 && self::dayIndex($date) !== 7;
    }

    public static function isNotHoliday($date)
    {
        $year = self::formatDate($date, 'Y');

        return ! Holiday::getAll($year)->contains($date);
    }

    public static function getDatesRange($from, $to) {

        $period = new CarbonPeriod($from, $to);

        $collection = collect($period->toArray());

        return $collection->transform(function($date, $key){
            return $date->format('Y-m-d');
        });
    }

    public static function countBusinessDays($from, $to)
    {
        $holidays = Holiday::getInDatesRange($from, $to);

        $holidaysExcludingWeekend = $holidays->filter(function($date, $key) {
            if (! self::get($date)->isWeekend()) {
                return true;
            }
        })->count();

        $days = self::get($from)->diffInDaysFiltered(function (Carbon $date) {
            return $date->isWeekday();
        }, self::get($to)) + 1;

        return $businessDaysCount = $days - $holidaysExcludingWeekend;
    }

    public static function get($date)
    {
        return $date instanceOf Carbon ? $date
            : Carbon::parse($date);
    }

    public static function createFrom($year, $month, $date, $format = "Y-m-d")
    {
        return Carbon::createFromDate($year, $month, $date)->format($format);
    }
}