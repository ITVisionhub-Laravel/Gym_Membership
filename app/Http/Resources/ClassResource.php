<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClassResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'image' => $this->image,
            'description' => $this->description,
            'morning_time' => $this->morning_time,
            'evening_time' => $this->evening_time,
            'trainer_id' => $this->trainer_id,
        ];
    }
}
