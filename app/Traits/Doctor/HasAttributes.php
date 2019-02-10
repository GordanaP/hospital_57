<?php

namespace App\Traits\Doctor;

trait HasAttributes
{
    /**
     * Determine if the doctor has an image.
     *
     * @return boolean
     */
    public function hasImage()
    {
        return $this->image;
    }

    /**
     * Determine if the doctor has a license.
     *
     * @return boolean
     */
    public function hasLicense()
    {
        return $this->license;
    }

    /**
     * Determine if the doctor has a biography.
     *
     * @return boolean
     */
    public function hasBiography()
    {
        return $this->biography;
    }
}