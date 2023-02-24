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
            'fb_name' => ['required', 'string'],
            'twitter_name' => ['required', 'string'],
            'linkin_name' => ['required', 'string'],
            'image' => ['nullable', 'mimes:png,jpg,jpeg'],
        ];
    }
}
