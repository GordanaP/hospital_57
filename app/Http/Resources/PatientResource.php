<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
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
            'name' => $this->inverse_name,
            'birthday' => $this->birthday,
            'doctor' => optional($this->doctor)->inverse_title_name,
            'link' => [
                'show' => route('patients.show', $this),
                'edit' => route('patients.edit', $this),
                'doctor' => $this->hasDoctor() ? route('doctors.show', $this->doctor) : '',
            ]
        ];
    }
}
