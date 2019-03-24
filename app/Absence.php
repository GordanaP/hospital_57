<?php

namespace App;

use App\Traits\Absence\Crudable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Absence extends Model
{
    use Crudable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'leave_type_id', 'start_at', 'end_at'
    ];

    protected $with = ['leave_type'];

    /**
     * Get the doctor that has the given absence.
     *
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    /**
     * Get the leave type that si assigned to the given absence.
     *
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function leave_type()
    {
        return $this->belongsTo(LeaveType::class);
    }

}
