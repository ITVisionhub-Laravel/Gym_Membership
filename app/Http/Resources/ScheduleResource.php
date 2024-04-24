<?php

namespace App\Http\Resources;

use App\Models\DaysOfWeek;
use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $daysOfWeeksName = DaysOfWeek::findOrFail($this->days_of_week_id);
        $daysName = $daysOfWeeksName->name;
        return [
            'id' => $this->id,
            'hours_From' => $this->hours_From,
            'hours_To' => $this->hours_To,
            'days_of_week_name' => $daysName
        ];
    }

    public function with($request)
    {
        return [
            'version' => '1.0.0',
            'api_url' => url('http://127.0.0.1:8000/api/schedule'),
            'message' => 'Your action is successful'
        ];
    }
}
