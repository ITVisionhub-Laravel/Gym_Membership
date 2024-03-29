<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AttendenceCheckResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'user_id'=>$this->user_id,
            'attendent_date' => $this->attendent_date
        ];
    }
}
