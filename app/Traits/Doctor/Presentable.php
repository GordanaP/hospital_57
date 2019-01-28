<?php

namespace App\Traits\Doctor;

use App\ValueObjects\Image;
use Carbon\Carbon;

trait Presentable
{
    /**
     * Set the first name.
     *
     * @param string $value
     * @return void
     */
    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = ucwords(strtolower($value));
    }

    /**
     * Set the last name.
     *
     * @param string $value
     * @return void
     */
    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = ucwords(strtolower($value));
    }

    /**
     * Get the full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Get the inverse full name.
     *
     * @return string
     */
    public function getInverseNameAttribute()
    {
        return $this->last_name . ' ' . $this->first_name;
    }

    /**
     * Get the full name preceeded by the title.
     *
     * @return string
     */
    public function getTitleNameAttribute()
    {
        return $this->title . ' ' . $this->full_name;
    }

    /**
     * Get the full name followed by the title.
     *
     * @return string
     */
    public function getInverseTitleNameAttribute()
    {
        return  $this->inverse_name .', '. $this->title;
    }

    /**
     * Get the last name preceeded by the title.
     *
     * @return string
     */
    public function getTitleLastNameAttribute()
    {
        return $this->title . ' ' . $this->last_name;
    }

    /**
     * Get the formatted license number.
     *
     * @return string
     */
    public function getFormattedLicenseAttribute()
    {
        return '#' . $this->license;
    }

    /**
     * Get the date of creation.
     *
     * @return date
     */
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }

    /**
     * Get the image.
     *
     * @param  string $value
     * @return string
     */
    public function getImageAttribute($value)
    {
        return new Image($value);
    }

}
