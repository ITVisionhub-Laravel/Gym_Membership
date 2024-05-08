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
        // dd(Address::where('user_id', $this->customer->id)->latest('updated_at')->first());
        $addressData = Address::where('user_id', $this->customer->id)->latest('updated_at')->first();
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
                'Street' => $addressData?->street->name,
                'Ward' => $addressData?->street->ward->name,
                'Township' => $addressData?->street->ward->township->name,
                'City' => $addressData?->street->ward->township->city->name,
                'State' => $addressData?->street->ward->township->city->state->name,
                'Country' => $addressData?->street->ward->township->city->state->country->name,
                'Block_no' => $addressData?->block_no,
                'Floor' => $addressData?->floor,
                'ZipCode' => $addressData?->zipcode
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
