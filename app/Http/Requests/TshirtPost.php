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
            'encomenda_id' => 'required',
            'estampa_id' => 'required',
            'cor_codigo' => 'required|string',
            'tamanho' => 'required|string',
            'quantidade' => 'required',
            'preco_un' => 'required',
            'subtotal' => 'required'
        ];
    }
}
