<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TownshipResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'name' => $this->name,
            'city_id' => $this->city_id
        ];
    }

    public function with($request)
    {
        return[
            'version' => '1.0.0',
            'api_url' => url('http://127.0.0.1:8000/api/country'),
            'message' => 'Your action is successful'
        ];
    }
}
