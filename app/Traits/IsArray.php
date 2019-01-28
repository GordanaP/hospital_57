<?php

namespace App\Traits;

trait IsArray
{
    /**
     * Get the array.
     *
     * @return array
     */
    public static function all()
    {
        return static::$array;
    }

    /**
     * Get the array's keys.
     *
     * @return array
     */
    public static function names()
    {
        return array_keys(static::all());
    }

    /**
     * Get the array's values.
     *
     * @return array
     */
    public static function values()
    {
        return array_values(static::all());
    }

    /**
     * Get the array of titles' key names.
     *
     * @return array
     */
    public static function namesArray() {

        return implode(',', static::names());

    }
}
