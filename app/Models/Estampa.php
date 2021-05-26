<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estampa extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable=[
        'nome',
        'descricao',
        'imagem_url',
        'informacao_extra'
    ];

    public function categoria(){
        return $this->belongsTo(Categoria::class, 'categoria_id', 'id')->withTrashed();
    }

    public function cliente(){
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id')->withTrashed();
    }

    public function tshirts(){
        return $this->hasMany(Tshirt::class, 'estampa_id', 'id');
    }
}
