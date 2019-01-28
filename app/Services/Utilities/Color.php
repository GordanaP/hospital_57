<?php

namespace App\Services\Utilities;

use App\Traits\IsArray;

class Color
{
    use IsArray;

    /**
     * A list of absence reasons.
     *
     * @var array
     */
    protected static $array = [

        '#EF5753' => "Red Light",
        '#E3342F' => "Red Base",
        '#CC1F1A' => "Red Dark",
        '#621B18' => "Red Darker",
        '#FAAD63' => "Orange Light",
        '#F6993F' => "Orange Base",
        '#DE751F' => "Orange Dark",
        '#51D88A' => "Green Light",
        '#38C172' => "Green Base",
        '#38C172' => "Green Dark",
        '#6CB2EB' => "Blue Light",
        '#3490DC' => "Blue Base",
        '#2779BD' => "Blue Dark",
        '#1C3D5A' => "Blue Darker",
        '#A779E9' => "Purple Light",
        '#9561E2' => "Purple Base",
        '#794ACF' => "Purple Dark",
    ];
}
