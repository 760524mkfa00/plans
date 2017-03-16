<?php

namespace Plans\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBuilding extends FormRequest
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
            'building_name' => 'required',
            'street' => 'required',
            'town' => 'required',
            'postal' => 'required',
            'province' => 'required',
            'country' => 'required',
            'telephone' => 'required',
            'description' => 'required',
            'building_type' => 'required',
        ];
    }
}
