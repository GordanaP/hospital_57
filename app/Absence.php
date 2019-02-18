<?php

namespace App;

use App\Traits\Absence\Crudable;
use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    use Crudable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description', 'start_at', 'end_at'
    ];

    /**
     * Get the doctor that has the given absence.
     *
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
