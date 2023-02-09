<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerFormRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'age' => ['required', 'integer'],
            'member_card_id' => ['required', 'integer'],
            'height' => ['required', 'string'],
            'weight' => ['required', 'string'],
            'city' => ['required', 'string'],
            'township' => ['required', 'string'],
            'street' => ['required', 'string'],
            'phone_number' => ['required', 'string'],
            'emergency_phone' => ['required', 'string'],
            'package' => ['required', 'string'],
            'promotion' => ['required', 'string'],
            'original_price' => ['required', 'string'],
            'price' => ['required', 'string'],
            'payment' => ['required', 'string'],
            'image' => ['nullable', 'mimes:jpg,jpeg,png'],
        ];
    }
}
