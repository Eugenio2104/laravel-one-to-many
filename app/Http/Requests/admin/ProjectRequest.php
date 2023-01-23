<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'name' => 'Required |min:2|max:50',
            'client_name' => 'Required |min:2|max:75',
            'cover_image' => 'nullable|image|max:18874368',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'campo obbligatorio',
            'name.min' => 'caratterini minimi :min',
            'name.max' => 'caratterini massimi :max',
            'client_name.required' => 'campo obbligatorio',
            'client_name.min' => 'caratterini minimi :min',
            'client_name.max' => 'caratterini massimi :max',
        ];
    }
}
