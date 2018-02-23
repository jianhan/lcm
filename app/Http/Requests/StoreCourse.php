<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'start' => 'required|date_format:d-m-Y H:i',
            'end' => 'required|date_format:d-m-Y H:i',
        ];
    }
}
