<?php

namespace App\Services\Utilities;

use App\Traits\IsArray;

class AppSlot
{
    use IsArray;

    /**
     * A list of absence reasons.
     *
     * @var array
     */
    protected static $array = [
        15 => "15 min",
        20 => "20 min",
        30 => "30 min",
    ];
}
