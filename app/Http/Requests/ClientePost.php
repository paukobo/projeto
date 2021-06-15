<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientePost extends FormRequest
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
            'name' =>           'required',
            'email' =>          'required|email|unique:users,email,'.$this->id,
            'foto' =>           'nullable|image|max:8192',
            'nif' =>            'nullable|digits:9',
            'endereco' =>       'nullable',
            'tipo_pagamento' => 'nullable|in:VISA,MC,PAYPAL',
            'ref_pagamento' =>  'nullable',
        ];
    }
}