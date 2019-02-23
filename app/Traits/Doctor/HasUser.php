<?php

namespace App\Traits\Doctor;

use App\User;

trait HasUser
{
    /**
     * Determine if the doctor has a user account.
     *
     * @return boolean
     */
    public function hasUser()
    {
        return $this->user;
    }

    /**
     * Associate a user with a doctor.
     *
     * @param integer $id
     * @return void
     */
    public function addUser($id)
    {
        $user = User::find($id);

        $user ? $this->user()->associate($user)->save() : '';
    }

    /**
     * Detache user from the doctor.
     *
     * @return void
     */
    public function detachUser()
    {
        $this->user()->dissociate()->save();
    }
}