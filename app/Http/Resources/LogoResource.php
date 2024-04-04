<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LogoResource extends JsonResource
{
    public function toArray($request)
    {
        return
        [
            'image' => $this->image,
            'name' => $this->name,
            'description' => $this->description,
            'address_id' => $this->address_id,
            'location' => $this->location,
            'ph_no' => $this->ph_no,
            'email' => $this->email,
            'open_day' => $this->open_day,
            'open_time' => $this->open_time,
            'close_day' => $this->close_day
        ];
        
    }

    public function with($request)
    {
        return [
            'version' => '1.0.0',
            'api_url' => url('http://127.0.0.1:8000/api/logo'),
            'message' => 'Your action is successful!'
        ];
    }
}
