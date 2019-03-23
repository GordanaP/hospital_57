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

    public static function groupByYear($year, $doctor)
    {
        $absences = $doctor->absences
            ->groupBy(function ($absence) {
                return Carbon::parse($absence->start_at)->format('Y');
            })->filter(function($value, $currentYear) use($year) {
                return $currentYear == $year;
            });

        return $absences;
    }
}
