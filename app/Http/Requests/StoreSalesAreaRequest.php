<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSalesAreaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=> ['required'],
            'phone' => ['required |regex:/(01)[0-9]{9}/'],
            'postalCodes' => ['required', 'array'],
            'postalCodes.*.codes' => array('required', 'regex:\d{5}|regex:?*?','current_code'),
            
        ];
    }
}
