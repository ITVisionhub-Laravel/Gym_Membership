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
    private $member;
    public function __construct($member)
    {
        $this->member = $member;
    }
    public function toArray($request)
    {
        // $addressData = Address::where('user_id', $this->member->id)->latest('updated_at')->first();
        $addressData = $this->member->address->last();
        return [
            'id' => $this->member->id,
            'name' => $this->member->name,
            'email' => $this->member->email,
            'member_card' => $this->member->member_card,
            'twitter' => $this->member->twitter,
            'facebook' => $this->member->facebook,
            'linkedIn' => $this->member->linkedIn,
            'age' => $this->member->age,
            'gender' => $this->member->gender,
            'height' => $this->member->height,
            'weight' => $this->member->weight,
            'mobile' => $this->member->phone_number,
            'emergency' => $this->member->emergency_phone,
            'image' => $this->member->image,
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
