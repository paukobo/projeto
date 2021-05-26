<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cor extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'cores';
    protected $primaryKey='codigo';
    protected $keyType='string';
    public $timestamps = false;

    protected $fillable=[
        'nome',
        'codigo'
    ];

    public function tshirts(){
        return $this->hasMany(Tshirt::class, 'cor_codigo', 'codigo');
    }

}
