<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShopResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'shop_type_id' => $this->shop_type_id
        ];
    }

    // public function with($request)
    // {
    //     return [
    //         'version' => '1.0.0',
    //         'api_url' => url('http://127.0.0.1:8000/api/shop'),
    //         'message' => 'Your action is successful!'
    //     ];
    // }
}
