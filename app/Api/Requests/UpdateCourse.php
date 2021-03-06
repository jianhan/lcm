<?php

namespace App\Api\Requests;

use App\Course;
use Dingo\Api\Http\FormRequest;


class UpdateCourse extends FormRequest
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
        $rules = Course::validationRules();
        $rules['name'][1]->ignore(\Request::get('id'));
        $rules['slug'][1]->ignore(\Request::get('id'));
        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return Course::validationMessages();
    }
}
