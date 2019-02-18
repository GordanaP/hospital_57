<?php

namespace App\Services\CustomClasses;

use Carbon\Carbon;

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
        return $date->dayOfWeekIso;
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
    public static function formatDate($date, $format)
    {
        return $date->format($format);
    }

    public static function createDate($date, $format = 'Y-m-d H:i')
    {
        return self::createFromFormat($format, $date)->toDateTimeString();
    }

    public static function isValidDate($date, $format='Y-m-d')
    {
        return date($format, strtotime($date)) == $date;
    }
}
