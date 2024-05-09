<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DebitAndCreditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            // 'name' => 'required|string',
            // 'amount' => 'required|integer',
            // 'date' => 'required|date', // Add the date validation rule here
            // 'transaction_id' => 'required|exists:transactions,id',
            'transaction_type_id' => 'required|exists:transaction_type,id',
        ];
    }
}