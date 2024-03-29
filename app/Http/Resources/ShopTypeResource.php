<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShopTypeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name'=>$this->name,
            'email'=>$this->email,
            'address_id'=>$this->address_id,
            'phone'=>$this->phone,
            'hot_line'=>$this->hot_line,
            'image'=>$this->image
        ];
    }
}
