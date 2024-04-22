<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AttendentResource extends JsonResource
{
    public function toArray($request)
    {
        return
        [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'attendent_date' => $this->attendent_date
        ];
    }

    public function with($request)
    {
        return [
            'version' => '1.0.0',
            'api_url' => url('http://127.0.0.1:8000/api/attendent'),
            'message' => 'Your action is successful'
        ];
    }
}
