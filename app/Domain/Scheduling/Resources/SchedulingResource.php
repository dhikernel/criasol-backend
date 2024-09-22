<?php

namespace App\Domain\Scheduling\Resources;

use App\Domain\Doctor\Resources\DoctorResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SchedulingResource extends JsonResource
{
    /**
     * @var mixed
     */

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'animal_name' => $this->animal_name,
            'animal_type' => $this->animal_type,
            'age' => $this->age,
            'symptoms' => $this->symptoms,
            'date' => $this->date,
            'period' => $this->period,
            'doctor' => DoctorResource::collection($this->whenLoaded('doctor')),
        ];
    }
}
