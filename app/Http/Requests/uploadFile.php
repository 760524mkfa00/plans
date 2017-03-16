<?php

namespace Plans\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class uploadFile extends FormRequest
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
            'building_id' => 'required',
            'floor_id' => 'required',
            'type_id' => 'required',
            'file_name' => 'required',
            'diagram' => 'required',
        ];
    }
}
