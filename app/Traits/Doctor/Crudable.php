<?php

namespace App\Traits\Doctor;

trait Crudable
{
    /**
     * The model's attributes.
     *
     * @return array
     */
    protected function attributes()
    {
        $attributes = request()->except('image');

        request('image') ? $attributes['image'] = request('image')->store('doctors', 'public') : '';

        request('deleteImage') ? $attributes['image'] = NULL : '';

        return $attributes;
    }
}
