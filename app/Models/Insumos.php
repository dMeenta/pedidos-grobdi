<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Insumos extends Model
{
    protected $table = 'insumos';

    public function excipientes()
    {
        return $this->hasMany(Bases::class,'presentacionfarmaceutica_id');
    }
}
