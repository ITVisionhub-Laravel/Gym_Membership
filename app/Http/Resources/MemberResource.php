<?php

namespace App\Http\Resources;

use App\Models\Address;
use Illuminate\Http\Resources\Json\JsonResource;

class MemberResource extends JsonResource
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
        // $addressData = Address::where('user_id', $this->customer->id)->latest('updated_at')->first();
        $addressData = $this->customer->address->last();
        return [
            'id' => $this->customer->id,
            'name' => $this->customer->name,
            'email' => $this->customer->email,
            'member_card' => $this->customer->member_card,
            'twitter' => $this->customer->twitter,
            'facebook' => $this->customer->facebook,
            'linkedIn' => $this->customer->linkedIn,
            'age' => $this->customer->age,
            'gender' => $this->customer->gender,
            'height' => $this->customer->height,
            'weight' => $this->customer->weight,
            'mobile' => $this->customer->phone_number,
            'emergency' => $this->customer->emergency_phone,
            'image' => $this->customer->image,
            'address' => [
                'street' => $addressData?->street->name,
                'ward' => $addressData?->street->ward->name,
                'township' => $addressData?->street->ward->township->name,
                'city' => $addressData?->street->ward->township->city->name,
                'state' => $addressData?->street->ward->township->city->state->name,
                'country' => $addressData?->street->ward->township->city->state->country->name,
                'block_no' => $addressData?->block_no,
                'floor' => $addressData?->floor,
                'zipCode' => $addressData?->zipcode
            ]
        ];
    }

    public function with($request)
    {
        return [
            'version' => '1.0.0',
            'api_url' => url('http://127.0.0.1:8000/api/country'),
            'message' => 'Your action is successful'
        ];
    }
}
