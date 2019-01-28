<?php

namespace App\Services\Utilities;

use App\Traits\IsArray;

class Specialty
{
    use IsArray;

    /**
     * A list of doctor specialties.
     *
     * @var array
     */
    protected static $array = [
        'cornea' => "Corneal diseases",
        'glaucoma' => "Glaucoma",
        'pediatrics' => "Pediatric ophtalmology",
        'retina' => "Retinal diseases",
        'orbita' => "Orbital and tear system diseases",
    ];
}
