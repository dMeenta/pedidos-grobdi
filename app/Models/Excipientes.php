<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Excipientes extends Model
{
    protected $table = 'excipientes';

    public function insumo()
    {
        return $this->belongsTo(Insumos::class);
    }
}
