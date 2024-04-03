<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExpensesResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'amount' => $this->amount,
            'invoice_slip' => $this->invoice_slip,
            'invoice_id' => $this->invoice_id
        ];
    }
    public function with($request)
    {
        return [
            'version' => '1.0.0',
            'api_url' => url('http://127.0.0.1:8000/api/expenses'),
            'message' => 'Your action is successful!'
        ];
    }
}
