<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DoctorResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->inverse_title_name,
            'specialty' => $this->specialty,
            'image_path' => $this->image->asPath() ?: '',
            'user' => optional($this->user)->email,
            'hasWorkSchedule' => $this->hasWorkSchedule(),
            'color' => $this->color,
            'link' => [
                'show' => route('doctors.show', $this),
                'edit' => route('doctors.edit', $this),
                'user' => $this->hasUser() ? route('users.show', $this->user) : '',
                'calendar' => $this->hasWorkSchedule() ? route('doctors.appointments.index', $this) : '',
            ]
        ];
    }
}
