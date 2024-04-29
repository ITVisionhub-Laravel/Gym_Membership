<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DashboardResource extends JsonResource
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
                // 'number_of_attended_member' => $this['attendedMembers']?->count(),
                // 'number_of_registered_member' => $this['members']?->count(),
                // 'number_of_payment_expired_member' => $this['payment'],
                // 'total_income' => $this['total_income'],
                // 'our_revenue' => $this['our_revenue'],
                // 'yufc_income' => $this['yufc_income'],
                // 'expenses' => $this['expenses'],
                // 'trainers' => $this['trainers'],
                'attended_members' => $this['partner']
            ];
       
    }

    public function with($request)
    {
        return [
            'version' => '1.0.0',
            'api_url' => url('http://127.0.0.1:8000/api/dashboard'),
            'message' => 'Your action is successful'
        ];
    }
}
