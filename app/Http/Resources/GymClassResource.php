<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GymClassResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image,
            'description' => $this->description,
            'gym_class_category_id' => $this->gym_class_category_id
        ];
    }

    public function with($request)
    {
        return [
            'version' => '1.0.0',
            'api_url' => url('http://127.0.0.1:8000/api/gymclass'),
            'message' => 'Your action is successful'
        ];
    }
}
