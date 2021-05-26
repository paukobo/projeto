<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tshirt extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable=[
        'tamanho',
        'quantidade',
        'preco_un'
    ];

    public function encomenda(){
        return $this->belongsTo(Encomenda::class, 'encomenda_id', 'id');
    }

    public function cor(){
        return $this->belongsTo(Cor::class, 'cor_codigo', 'codigo');
    }

    public function estampa(){
        return $this->belongsTo(Estampa::class, 'estampa_id', 'id');
    }

}