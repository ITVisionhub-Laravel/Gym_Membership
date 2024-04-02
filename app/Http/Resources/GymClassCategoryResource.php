<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GymClassCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    { 
        return[
            'id' => $this->id,
            'name'=>$this->name,
            'image'=>$this->image,
            'description'=>$this->description
        ];
    }

    public function with($request)
    {
        return [
            'version' => '1.0.0',
            'api_url' => url('http://127.0.0.1:8000/api/gymclass-category'),
            'message' => 'Your action is successful'
        ];
    }
}
