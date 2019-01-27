<?php

namespace App\Traits\User;

use Carbon\Carbon;

trait Presentable
{
    /**
     * Set the password.
     *
     * @param string $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $value ? $this->attributes['password'] = bcrypt($value) : '';
    }

    /**
     * Set the email.
     *
     * @param string $value
     * @return void
     */
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
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

}