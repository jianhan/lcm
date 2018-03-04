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
            'file.*' => 'mimetypes:image/jpeg,image/png,image/gif,image/png|max:1024',
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
        $messages = [];
        foreach ($this->request->get('file') as $key => $value) {
            $fileName = $value->getClientOriginalName();
            $messages['file.' . $key . '.required'] = 'File ' . $fileName . '  is required';
            $messages['file.' . $key . '.mimes'] = 'File ' . $fileName . ' must be a image of jpg,jepg,png or gif';
            $messages['file.' . $key . '.max'] = 'File ' . $fileName . ' must not be over 1MB';
        }
        $messages['dir.required'] = 'Dir parameter is required';
        $messages['dir.string'] = 'Dir parameter must be a string';
        return $messages;
    }
}