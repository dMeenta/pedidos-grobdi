<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Insumos extends Model
{
    protected $table = 'insumos';

    public function excipientes()
    {
        return $this->hasMany(Excipientes::class,'insumos_id');
    }
    public function base()
    {
        return $this->belongsTo(Bases::class,'bases_id');
    }
}
