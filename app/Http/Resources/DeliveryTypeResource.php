<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DeliveryTypeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'image'=> $this->image,
            'kg'=> $this->kg,
            'township_id'=> $this->township_id,
            'cost'=> $this->cost,
            'waiting_time'=> $this->waiting_time
        ];
    }
}
