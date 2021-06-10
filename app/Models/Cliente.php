<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cliente extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = false;
    protected $fillable = [
        'nif',
        'endereco',
        'tipo_pagamento',
        'ref_pagamento',
    ];

    public $incrementing=false;

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id')->withTrashed();
    }

}
