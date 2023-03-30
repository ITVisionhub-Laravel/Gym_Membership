<?php

namespace App\Http\Requests\Delivery;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryTypeFormRequest extends FormRequest
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
            'name' => ['string', 'required'],
            'image' => ['nullable', 'mimes:png,jpg,jpeg'],
            'kg' => ['integer', 'required'],
            'township_id' => ['integer', 'required'],
            'cost' => ['integer', 'required'],
            'waiting-time' => ['string', 'required'],
        ];
    }
}
