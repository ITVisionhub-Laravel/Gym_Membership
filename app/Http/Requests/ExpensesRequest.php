<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpensesRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'amount' => 'required|integer',
            'invoice_slip' => ['nullable', 'image', 'mimes:jpg,jpeg,png'],
            'invoice_id' => 'required|string',
        ];
    }
}