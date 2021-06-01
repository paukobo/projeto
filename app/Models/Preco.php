<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Preco extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable=[
        'preco_un',
        'preco_un_proprio',
        'preco_un_catalogo_desconto',
        'preco_un_proprio_desconto',
        'quantidade_desconto'
    ];
}
