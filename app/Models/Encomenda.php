<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encomenda extends Model
{

    use HasFactory;

    protected $fillable=[
        'estado',
        'data',
        'preco_total',
        'notas',
        'nif',
        'endereco',
        'tipo_pagamento',
        'ref_pagamento',
        'recibo_url'
    ];

    public function tshirts(){
        return $this->hasMany(Tshirt::class, 'cor_codigo', 'codigo');
    }

    public function cliente(){
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id')->withTrashed();
    }
}
