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
    public function with($request)
    {
        return [
            'version' => '1.0.0',
            'api_url' => url('http://127.0.0.1:8000/api/delivery-type'),
            'message' => 'Your action is successful'
        ];
    }
}
