<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TshirtPost extends FormRequest
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
            'estampa_id' => 'required',
            'cor_codigo' => 'required|string|max:6',
            'tamanho' => 'required|in:"XS", "S", "M", "L", "XL"',
            'quantidade' => 'required|integer|min:1|max:99',
            'preco_un' => 'required|integer'
        ];
    }
}
