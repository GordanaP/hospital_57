<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'doctor' => optional($this->doctor)->inverse_name,
            'link' => [
                'show' => route('users.show', $this),
                'edit' => route('users.edit', $this),
                'doctor' => $this->hasDoctor() ? route('doctors.show', $this->doctor) : '',
            ]
        ];
    }
}
