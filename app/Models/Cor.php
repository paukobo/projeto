<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cor extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = false;

    protected $table= 'cores';
    protected $primaryKey = 'codigo';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable=[
        'codigo',
        'nome'
    ];

    public function tshirt(){
        return $this->hasMany('App\Models\Tshirt', 'cor_codigo', 'codigo');
    }
}
