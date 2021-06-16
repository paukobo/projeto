<?php

namespace App\Http\Requests;

use App\Rules\VerifyPass;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PasswordPost extends FormRequest
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
            'oldPass' =>        ['required',new VerifyPass()],
            'newPass' =>        'required',
            'confirmPass' =>    'required',
        ];
    }
}