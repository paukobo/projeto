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
        $rules = '';

        if ($this->tipo_pagamento == 'PAYPAL'){
            $rules = 'email';
        }

        if ($this->tipo_pagamento == 'VISA' || $this->tipo_pagamento == 'MC'){
            $rules = 'digits:16';
        }

        return [
            'estado' => 'required|string|in:"paga", "pendente", "anulada", "fechada"',
            'data' => 'required|date',
            'notas' => 'nullable|string',
            'nif' => 'required|digits:9',
            'endereco' => 'required',
            'tipo_pagamento' => 'required|in:"PAYPAL", "MC", "VISA"',
            'ref_pagamento' => 'required|' . $rules,
            'recibo_url' => 'nullable'
        ];
    }
}
