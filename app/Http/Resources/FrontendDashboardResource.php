<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FrontendDashboardResource extends JsonResource
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
                'logo' => $this['logo'],
                'partner' => $this['partner'],
                'gymClasses' => $this['days_of_week'],
                'days_of_week' => $this['days_of_week'],
                'class_categories' => $this['class_categories'],
                'gymTrainers' => $this['gymTrainers']
            ];
       
    }

    public function with($request)
    {
        return [
            'version' => '1.0.0',
            'api_url' => url('http://127.0.0.1:8000/api/frontend-dashboard'),
            'message' => 'Your action is successful'
        ];
    }
}
