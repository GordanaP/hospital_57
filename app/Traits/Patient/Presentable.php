<?php

namespace App\Traits\Patient;

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
     * Get the date of creation.
     *
     * @return date
     */
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }

    /**
     * Get the gender name.
     *
     * @return string
     */
    public function getGenderNameAttribute()
    {
        return $this->gender === "M" ? 'Male' : 'Female';
    }

    /**
     *  Get the age.
     *
     * @return integer
     */
    public function getAgeAttribute()
    {
        return Carbon::parse($this->birthday)->age;
    }

    /**
     * Get the full address.
     *
     * @return string
     */
    public function getFullAddressAttribute()
    {
        return $this->address .', '. $this->postal_code .' '. $this->city;
    }
}
