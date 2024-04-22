<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShopTypeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name'=>$this->name,
            'email'=>$this->email,
            'address_id'=>$this->address_id,
            'phone'=>$this->phone,
            'hot_line'=>$this->hot_line,
            'image'=>$this->image
        ];
    }
    public function with($request)
    {
        return [
            'version' => '1.0.0',
            'api_url' => url('http://127.0.0.1:8000/api/shop-types'),
            'message' => 'Your action is successful'
        ];
    }
}
