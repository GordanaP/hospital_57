<?php

namespace App\Services\Utilities;

use App\Traits\IsArray;

class Day
{
    use IsArray;

    /**
     * A list of working days.
     *
     * @var array
     */
    protected static $array = [
        '1' => "Monday",
        '2' => "Tuesday",
        '3' => "Wednesday",
        '4' => "Thursday",
        '5' => "Friday",
        '6' => "Saturday",
    ];
}
