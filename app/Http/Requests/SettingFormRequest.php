<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingFormRequest extends FormRequest
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
            'website_name'=>'required|string',
            'website_url'=>'required|string',
            'page_title'=>'required|string',
            'meta_keyword'=>'required|string',
            'meta_description'=>'required|string',
            'address'=>'required|string',
            'phone'=>'required|string',
            'email'=>'required|email|unique:users',
            'facebook'=>'required|string',
            'twitter'=>'required|string',
            'instagram'=>'required|string'
        ];
    }
}
