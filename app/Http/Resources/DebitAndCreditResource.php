<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DebitAndCreditResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'amount' => $this->amount,
            'date' => $this->date,
            'related_info_type' => $this->related_info_type,
            'related_info_id' => $this->related_info_id,
            'transaction_type_id' => $this->transaction_type_id,
            'status_id' => $this->status_id
        ];
    }

    public function with($request)
    {
        return [
            'version' => '1.0.0',
            'api_url' => url('http://127.0.0.1:8000/api/debit-credit'),
            'message' => 'Your action is successful!'
        ];
    }
}
