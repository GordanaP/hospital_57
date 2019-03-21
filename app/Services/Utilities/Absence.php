<?php

namespace App\Services\Utilities;

use App\Traits\IsArray;

class Absence
{
    use IsArray;

    /**
     * A list of absence reasons.
     *
     * @var array
     */
    protected static $array = [
        'vacation' => "Vacation",
        'medical' => "Medical reason",
        'family' => "Family activities",
        'military' => "Military service",
        'business' => "Scientific meeting",
        'unexcused' => "Unexcused absence",
        'other' => "Other reason",
    ];

}
