<?php

namespace App\Services\Utilities;

use App\Traits\IsArray;

class Title
{
    use IsArray;

    /**
     * A list of doctor titles.
     *
     * @var array
     */
    protected static $array = [
        'Dr' => "Dr",
        'Prim. Dr' => "Prim. Dr",
        'Ass. Dr' => "Ass. Dr",
        'Doc. Dr' => "Doc. Dr",
        'Prof. Dr' => "Prof. Dr",
    ];
}
