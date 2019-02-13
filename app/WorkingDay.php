<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkingDay extends Model
{
    /**
     * Get the doctors at work on the given working days.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function doctors()
    {
        return $this->belongsToMany(Doctor::class)
            ->as('hour')
            ->withPivot('start_at', 'end_at');
    }
}
