<?php

namespace App\Http\Resources;

use App\Services\CustomClasses\AppCarbon;
use Illuminate\Http\Resources\Json\JsonResource;

class AbsenceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'doctor' => $this->doctor->inverse_title_name,
            'doctor_id' => $this->doctor->id,
            'start_at' => $this->start_at,
            'end_at' => $this->end_at,
            'leave_types' => $this->doctor->leave_types,
            'type' => $this->leave_type->name,
            'color' => $this->leave_type->color,
            'days_count' => AppCarbon::countBusinessDays($this->start_at, $this->end_at),
            'link' => [
                'edit' => route('absences.edit', $this),
                'doctor' => route('doctors.show', $this->doctor, $this),
            ]
        ];
    }
}
