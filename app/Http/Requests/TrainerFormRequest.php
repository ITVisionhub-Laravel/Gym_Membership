<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrainerFormRequest extends FormRequest
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
            'description' => ['required', 'string'],
            'fb_name' => ['nullable', 'string'],
            'twitter_name' => ['nullable', 'string'],
            'linkin_name' => ['nullable', 'string'],
            'image' => ['nullable', 'mimes:png,jpg,jpeg'],
        ];
    }
}
