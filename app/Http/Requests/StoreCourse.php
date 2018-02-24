<?php

namespace App\Http\Requests;

use Dingo\Api\Http\FormRequest;

class StoreCourse extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:courses,name',
            'slug' => 'required|unique:courses,slug|alpha_dash',
            'description' => 'required|max:1024',
            'start' => 'required|regex:' . \Config::get('constants.api.date_format_regex'),
            'end' => 'required|regex:' . \Config::get('constants.api.date_format_regex'),
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'A name is required',
            'slug.required' => 'A slug is required',
        ];
    }
}
