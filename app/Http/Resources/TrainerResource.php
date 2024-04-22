<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TrainerResource extends JsonResource
{
    public function toArray($request)
    {
        return
        [
            'id' => $this->id,
            'image' => $this->image,
            'name' => $this->name,
            'description' => $this->description,
            'fb_name' => $this->fb_name,
            'twitter_name' => $this->twitter_name,
            'linkin_name' => $this->linkin_name,
        ];
    }

    public function with($request)
    {
        return [
            'version' => '1.0.0',
            'api_url' => url('http://127.0.0.1:8000/api/trainer'),
            'message' => 'Your action is successful!'
        ];
    }
}
