<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentExpiredMemberResource extends JsonResource
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
            'id' => $this['id'],
            'expired_date' => $this->expired_date,
            'extra_day' => $this->extra_day,
            'user' => $this->user
        ];
    }

    public function with($request)
    {
        return [
            'version' => '1.0.0',
            'api_url' => url('http://127.0.0.1:8000/api/payment_expired_members'),
            'message' => 'Your action is successful'
        ];
    }
}
