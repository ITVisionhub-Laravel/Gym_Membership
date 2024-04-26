<?php

namespace App\Http\Resources;

use App\Models\Street;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class SearchMemberResource extends JsonResource
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
            'age' => $this->age,
            'gender' => $this->gender,
            'height' => $this->height,
            'weight' => $this->weight,
            'phone_number' => $this->phone_number,
            'emergency_phone' => $this->emergency_phone,
            'image' => $this->image,
            'address' => $this->address->map(function ($address) {
                $streetData = Street::findOrFail($address->street_id);
                return [
                    'street' => $address->street->name,
                    'ward' => $address->street->ward->name,
                    'township' => $address->street->ward->township->name,
                    'city' => $address->street->ward->township->city->name,
                    'block_no' => $address->block_no,
                    'floor' => $address->floor,
                    'zipcode' => $address->zipcode,
                    'created_at' => $address->created_at,
                    'updated_at' => $address->updated_at
                ];
            }),
        ];
    }

    public function with($request)
    {
        return [
            'version' => '1.0.0',
            'api_url' => url('http://127.0.0.1:8000/api/admin/search_member'),
            'message' => 'Your action is successful'
        ];
    }
}
