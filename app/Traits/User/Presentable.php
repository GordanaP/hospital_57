<?php

namespace App\Traits\User;

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
}