<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberInfoValidation extends FormRequest
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
            'email' => ['required', 'string'],
            'age' => ['required', 'integer'],
            'image' => ['nullable', 'mimes:jpg,jpeg,png'],
            'gymclass' => ['required', 'string'],
            'height' => ['required', 'string'],
            'weight' => ['required', 'string'],
            'phone_number' => ['required', 'string'],
            'emergency_phone' => ['required', 'string'],
            'facebook' => ['nullable'],
            'twitter' => ['nullable'],
            'linkedIn' => ['nullable']
        ];
    }
}
