<?php

namespace App\Http\Resources;

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
            'description' => $this->description,
            'link' => [
                'edit' => route('absences.edit', $this),
                // 'editForDoctor' => route('doctors.absences.edit', [$this->doctor, $this]),
                'doctor' => route('doctors.show', $this->doctor, $this),
            ]
        ];
    }
}
