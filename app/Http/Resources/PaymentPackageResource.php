<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentPackageResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'package' => $this->package,
            'promotion' => $this->promotion,
            'original_price' => $this->original_price,
            'promotion_price' => $this->promotion_price
        ];
    }

    public function with($request)
    {
        return [
            'version' => '1.0.0',
            'api_url' => url('http://127.0.0.1:8000/api/package'),
            'message' => 'Your action is successful!'
        ];
    }
}
