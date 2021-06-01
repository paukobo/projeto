<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EncomendaPost extends FormRequest
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
            'estado' => 'required|string',
            'data' => 'required',
            'preco_total' => 'required',
            'notas' => 'nullable|string',
            'nif' => 'required',
            'endereco' => 'required',
            'tipo_pagamento' => 'required',
            'refo_pagamento' => 'required',
            'recibo_url' => 'nullable'
        ];
    }
}
