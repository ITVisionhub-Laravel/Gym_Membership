<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BrandsResource extends JsonResource
{
    public function toArray($request)
    {
        return
        [
            'name' => $this->name,
            'slug' => $this->slug
        ];
    }
}
