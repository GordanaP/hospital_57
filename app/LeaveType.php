<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    /**
     * Get the leave type's absences.
     *
     * @return  \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function absences()
    {
        return $this->hasMany(Absence::class);
    }

    /**
     * Get the leave type's leave doctors.
     *
     * @return  \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function doctors()
    {
        return $this->belongsToMany(Doctor::class)
            // ->as('days_count')
            ->withPivot('year', 'total');
    }
}
