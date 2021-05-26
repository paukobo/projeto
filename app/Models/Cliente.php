<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable=[
        'nif',
        'endereco',
        'tipo_pagamento',
        'ref_pagamento'
    ];


    public function estampas(){
        return $this->hasMany(Estampa::class, 'estampa_id', 'id')->withTrashed();
    }

    public function user(){
        return $this->belongsTo(Cliente::class, 'id', 'id');
    }

    public function encomenda(){
        return $this->hasOne(Encomenda::class, 'encomenda_id', 'id');
    }

}
