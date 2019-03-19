<?php

namespace App\Services\CustomClasses;

use App\Services\CustomClasses\AppCarbon;
use Carbon\Carbon;

class Holiday
{
    /**
     * Get all holidays.
     *
     * @param  string $year
     * @param  string $format
     * @return Illuminate\Support\Collection
     */
    public static function getAll($year, $format="Y-m-d")
    {
        $holiday = new self;

        $NewYearDay = $holiday->NewYearDay($year);
        $ChristmasDay = $holiday->ChristmasDay($year);
        $SovereigntyDay = $holiday->SovereigntyDay($year);
        $EasterHoliday = $holiday->OrthodoxEaster($year, $format);
        $LabourDay = $holiday->LabourDay($year);
        $ArmisticeDay = $holiday->ArmisticeDay($year);

        return $NewYearDay->concat($ChristmasDay)->concat($SovereigntyDay)
            ->concat($EasterHoliday)->concat($LabourDay)->concat($ArmisticeDay);
    }

    /**
     * Get holidays in a range of dates.
     *
     * @param  string $from
     * @param  string $to
     * @return Illuminate\Support\Collection
     */
    public static function getInDatesRange($from, $to)
    {
        $datesRange = AppCarbon::getDatesRange($from, $to);
        $fromDate = AppCarbon::get($from);
        $toDate = AppCarbon::get($to);

        if ($fromDate->isSameYear($toDate)) {

            $holidays = self::getAll($fromDate->year);

        } else {

            $holidaysFromYear = self::getAll($fromDate->year);
            $holidaysToYear = self::getAll($toDate->year);

            $holidays = $holidaysFromYear->merge($holidaysToYear);
        }

        return $datesRange->intersect($holidays);
    }

    /**
     * Count holidays in a range of dates.
     *
     * @param  string $from
     * @param  string $to
     * @return integer
     */
    public static function countInDatesRange($from, $to)
    {
        return self::getInDatesRange($from, $to)->count();
    }

    /**
     * Get New Year Day.
     *
     * @param string $year
     * @return Illuminate\Support\Collection
     */
    private function NewYearDay($year)
    {
        $January1 = AppCarbon::createFrom($year, 1, 1);
        $January2 = AppCarbon::createFrom($year, 1, 2);
        $January3 = AppCarbon::get($January1)->isSunday()
            || AppCarbon::get($January2)->isSunday()
            ? AppCarbon::createFrom($year, 1, 3) : '';

        return collect([$January1, $January2, $January3])->filter();
    }

    /**
     * Get Christmas Day.
     *
     * @param string $year
     * @return Illuminate\Support\Collection
     */
    private function ChristmasDay($year)
    {
        $ChristmasDay = AppCarbon::createFrom($year, 1, 7);

        return collect($ChristmasDay);
    }

    /**
     * Get Sovereignty Day.
     *
     * @param string $year
     * @return Illuminate\Support\Collection
     */
    private function SovereigntyDay($year)
    {
        $February15 = AppCarbon::createFrom($year, 2, 15);
        $February16 = AppCarbon::createFrom($year, 2, 16);
        $February17 = AppCarbon::get($February15)->isSunday()
            || AppCarbon::get($February16)->isSunday()
            ? AppCarbon::createFrom($year, 2, 17) : '';

        return collect([$February15, $February16, $February17])->filter();
    }

    /**
     * Get Orthodox Easter.
     *
     * @param string $year
     * @param string $format
     * @return Illuminate\Support\Collection
     */
    private function OrthodoxEaster($year, $format = 'Y-m-d')
    {
        $EasterSunday = (new self)->EasterSunday($year);
        $GoodFriday = AppCarbon::get($EasterSunday)->subDays(2)->format($format);
        $EasterMonday = AppCarbon::get($EasterSunday)->addDay(1)->format($format);

        return collect([$GoodFriday, $EasterSunday, $EasterMonday]);
    }

    /**
     * Get Labour Day.
     *
     * @param string $year
     * @return Illuminate\Support\Collection
     */
    private function LabourDay($year)
    {
        $May1 = AppCarbon::createFrom($year, 5, 1);
        $May2 = AppCarbon::createFrom($year, 5, 2);
        $May3 = AppCarbon::get($May1)->isSunday()
            || AppCarbon::get($May2)->isSunday()
            ? AppCarbon::createFrom($year, 5, 3) : '';

        return collect([$May1, $May2, $May3])->filter();
    }

    /**
     * Get Armistice Day.
     *
     * @param string $year
     * @return Illuminate\Support\Collection
     */
    private function ArmisticeDay($year)
    {
        $November11 = AppCarbon::createFrom($year, 11, 11);
        $November12 = AppCarbon::get($November11)->isSunday()
            ? AppCarbon::createFrom($year, 11, 12) : '';

        return collect([$November11, $November12])->filter();
    }

    /**
     * Get Easter Sunday.
     *
     * @param string $year
     * @param string
     */
    private function EasterSunday($year)
    {
        $a = $year % 4;
        $b = $year % 7;
        $c = $year % 19;
        $d = (19 * $c + 15) % 30;
        $e = (2 * $a + 4 * $b - $d + 34) % 7;
        $month = floor(($d + $e + 114) / 31);
        $day = (($d + $e + 114) % 31) + 1;

        return AppCarbon::createFrom($year, $month, ($day+13));
    }
}
