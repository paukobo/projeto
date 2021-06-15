<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tshirt extends Model
{
    use HasFactory;

    protected $fillable=[
        'encomenda_id',
        'estampa_id',
        'cor_codigo',
        'tamanho',
        'quantidade',
        'preco_un'
    ];

    public function encomenda(){
        return $this->belongsTo(Encomenda::class, 'encomenda_id', 'id')->withTrashed();
    }

    public function cor(){
        return $this->belongsTo(Cor::class, 'cor_codigo', 'codigo')->withTrashed();
    }

    public function estampa(){
        return $this->belongsTo(Estampa::class, 'estampa_id', 'id')->withTrashed();
    }

}
