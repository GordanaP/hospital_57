<?php

namespace App\Traits\Doctor;

trait GetAttributes
{
    /**
     * The doctor's attributes.
     *
     * @return array
     */
    protected function attributes()
    {
        $attributes = request()->except('image', 'user_id');

        request('image') ? $attributes['image'] = request('image')->store('doctors', 'public') : '';

        request('deleteImage') ? $attributes['image'] = NULL : '';

        return $attributes;
    }
}
