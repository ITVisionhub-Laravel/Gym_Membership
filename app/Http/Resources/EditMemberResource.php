<?php

namespace App\Http\Resources;

use App\Models\Address;
use App\Models\GymClass;
use Illuminate\Http\Resources\Json\JsonResource;

class EditMemberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    private $customer;

    public function __construct($customer)
    {
        $this->customer = $customer;
    }

    public function toArray($request)
    {
        $gymClassData = GymClass::findOrFail($this->customer->gym_class_id);
        $addressData = Address::findOrFail($this->customer->id);

        return [
            'id' => $this->customer->id,
            'name' => $this->customer->name,
            'email' => $this->customer->email,
            'age' => $this->customer->age,
            'gender' => $this->customer->gender,
            'image' => $this->customer->image,
            'class' => $gymClassData->name,
            'Height' => $this->customer->height,
            'Weight' => $this->customer->weight,
            'Mobile' => $this->customer->phone_number,
            'Emergency Mobile' => $this->customer->emergency_phone,
            'Address' => [
                'Street' => $addressData->street->name,
                'Ward' => $addressData->street->ward->name,
                'Township' => $addressData->street->ward->township->name,
                'City' => $addressData->street->ward->township->city->name,
                'State' => $addressData->street->ward->township->city->state->name,
                'Country' => $addressData->street->ward->township->city->state->country->name,
                'Block_no' => $addressData->block_no,
                'Floor' => $addressData->floor,
                'ZipCode' => $addressData->zipcode
            ],

        ];
    }
}
