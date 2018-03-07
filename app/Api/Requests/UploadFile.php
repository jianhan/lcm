<?php

namespace App\Api\Requests;

use Dingo\Api\Http\FormRequest;

class UploadFile extends FormRequest
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
            'file' => 'mimetypes:image/jpeg,image/png,image/gif,image/png|max:1024',
            'dir' => 'required|string'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        $fileName = '';
        if ($this->request->get('file', false)) {
            $fileName = $this->request->get('file')->getClientOriginalName();
        }
        return [
            'file.required' => 'File is required',
            'file.mimes' => 'File ' . $fileName . ' must be a image of jpg,jepg,png or gif',
            'file.max' => 'File ' . $fileName . ' must not be over 1MB',
            'dir.required' => 'Dir parameter is required',
            'dir.string' => 'Dir parameter must be a string'
        ];
    }
}