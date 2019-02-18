<?php

namespace App\Services\CustomClasses;

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
     * Get New Year Day.
     *
     * @param string $year
     * @return Illuminate\Support\Collection
     */
    private function NewYearDay($year)
    {
        $holiday = new self;

        $January1 = $holiday->createDay($year, 1, 1);
        $January2 = $holiday->createDay($year, 1, 2);
        $January3 = $holiday->isSunday($January1) || $holiday->isSunday($January2)
            ? $holiday->createDay($year, 1, 3) : '';

        $NewYearDay = [];

        array_push ($NewYearDay, $January1, $January2, $January3);

        return collect($NewYearDay)->filter();
    }

    /**
     * Get Christmas Day.
     *
     * @param string $year
     * @return Illuminate\Support\Collection
     */
    private function ChristmasDay($year)
    {
        $holiday = new self;

        $ChristmasDay = $holiday->createDay($year, 1, 7);

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
        $holiday = new self;

        $February15 = $holiday->createDay($year, 2, 15);
        $February16 = $holiday->createDay($year, 2, 16);
        $February17 = $holiday->isSunday($February15) || $holiday->isSunday($February16)
            ? $holiday->createDay($year, 2, 17) : '';

        $SovereigntyDay = [];

        array_push ($SovereigntyDay, $February15, $February16, $February17);

        return collect($SovereigntyDay)->filter();
    }

    /**
     * Get Orthodox Easter.
     *
     * @param string $year
     * @param string $format
     * @return Illuminate\Support\Collection
     */
    private function OrthodoxEaster($year, $format)
    {
        $holiday = new self;

        $EasterSunday = $holiday->EasterSunday($year);
        $GoodFriday = Carbon::parse($EasterSunday)->subDays(2)->format($format);
        $EasterMonday = Carbon::parse($EasterSunday)->addDay(1)->format($format);

        $EasterHoliday = [];

        array_push($EasterHoliday, $GoodFriday, $EasterSunday, $EasterMonday);

        return collect($EasterHoliday);
    }

    /**
     * Get Labour Day.
     *
     * @param string $year
     * @return Illuminate\Support\Collection
     */
    private function LabourDay($year)
    {
        $holiday = new self;

        $May1 = $holiday->createDay($year, 5, 1);
        $May2 = $holiday->createDay($year, 5, 2);
        $May3 = $holiday->isSunday($May1) || $holiday->isSunday($May2)
            ? $holiday->createDay($year, 5, 3) : '';

        $LabourDay = [];

        array_push ($LabourDay, $May1, $May2, $May3);

        return collect($LabourDay)->filter();
    }

    /**
     * Get Armistice Day.
     *
     * @param string $year
     * @return Illuminate\Support\Collection
     */
    private function ArmisticeDay($year)
    {
        $holiday = new self;

        $November11 = $holiday->createDay($year, 11, 11);
        $November12 = $holiday->isSunday($November11) ? $holiday->createDay($year, 11, 12) : '';

        $ArmisticeDay = [];

        array_push ($ArmisticeDay, $November11, $November12);

        return collect($ArmisticeDay)->filter();
    }

    /**
     * Get Easter Sunday.
     *
     * @param string $year
     * @param string
     */
    private function EasterSunday($year)
    {
        $holiday = new self;

        $a = $year % 4;
        $b = $year % 7;
        $c = $year % 19;
        $d = (19 * $c + 15) % 30;
        $e = (2 * $a + 4 * $b - $d + 34) % 7;
        $month = floor(($d + $e + 114) / 31);
        $day = (($d + $e + 114) % 31) + 1;

        return $holiday->createDay($year, $month, ($day+13));
    }

    /**
     * Determine if a date is Sunday.
     *
     * @param  string  $date
     * @return boolean
     */
    private function isSunday($date)
    {
        return Carbon::parse($date)->dayOfWeekIso == 7;
    }

    /**
     * Create a day.
     *
     * @param  integer $year
     * @param  integer $month
     * @param  integer $date
     * @param  string $format
     * @return \Carbon\Carbon
     */
    private function createDay($year, $month, $date, $format = "Y-m-d")
    {
        return Carbon::createFromDate($year, $month, $date)->format($format);
    }
}
