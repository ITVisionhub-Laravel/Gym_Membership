<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GymClassFormRequest extends FormRequest
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
            'name'=>'required|string',
            'description'=>'required|string|max:225',
            'image'=>'nullable|mimes:png,jpg,jpeg',
            'gym_class_category_id'=>'required'
        ];
    }
}
