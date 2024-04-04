<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LogoRequest extends FormRequest
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
            'name' => ['string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png'],
            'description' => ['required', 'string'],
            'location' => ['required', 'string'],
            'address_id' => ['required', 'string'],
            'ph_no' => ['required', 'string'],
            'email' => ['required', 'string'],
            'open_day' => ['required', 'string'],
            'open_time' => ['required', 'string'],
            'close_day' => ['required', 'string'],
        ];
    }
}
