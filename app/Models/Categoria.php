<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $timestamps = false;

    public function estampas(){
        return $this->hasMany(Estampa::class, 'categoria_id', 'id')->withTrashed();
    }
}