<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstampaPost extends FormRequest
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
       $regras = [
            'nome' => 'required|string',
            'descricao' => 'nullable|string',
            'imagem_url' => 'required|image',
            'informacao_extra' => 'nullable',
        ];
        if(auth()->user()->tipo!='C'){
            $regras['categoria_id']='nullable|exists:categorias,id';
        }
        return $regras;
    }
}
