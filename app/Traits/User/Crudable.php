<?php

namespace App\Traits\User;

trait Crudable
{
    /**
     * The user attributes.
     *
     * @return array
     */
    public function attributes()
    {
        $attributes = request()->except('password');

        if (request('handle-password') == 'auto') {

            $attributes['password'] = str_random(6);
        }
        else if (request('handle-password') == 'manual') {

            $attributes['password'] = request('password');
        }

        return $attributes;
    }

    /**
     * Get the password.
     *
     * @return string
     */
    public function getPassword()
    {
        return array_key_exists("password", $this->attributes())
            ? $this->attributes()['password'] : '';
    }
}