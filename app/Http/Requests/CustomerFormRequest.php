<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'email' => ['required', 'string','email',Rule::unique("users","email")],
            'age' => ['required', 'integer'],
            'gender' => ['required'],
            'height' => ['required', 'string'],
            'weight' => ['required', 'string'],
            'phone_number' => ['required', 'string'],
            'emergency_phone' => ['required', 'string'],
            'gym_class_id' => ['required', 'string'],
            'image' => ['nullable', 'mimes:jpg,jpeg,png'],
            'street_id' => ['nullable', 'string'],
            'block_no' => ['nullable', 'string'],
            'floor' => ['nullable', 'string'],
            'zipcode' => ['nullable', 'string'],
            'facebook' => ['nullable', 'string'],
            'twitter' => ['nullable', 'string'],
            'linkedIn' => ['nullable', 'string'],
            'user_id' => ['nullable', 'string']
        ];
    }
}
