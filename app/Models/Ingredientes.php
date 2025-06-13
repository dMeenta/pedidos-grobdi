<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredientes extends Model
{
    protected $table = 'ingredientes';

    public function excipientes()
    {
        return $this->hasMany(Excipientes::class,'insumos_id');
    }
    public function base()
    {
        return $this->belongsTo(Bases::class,'bases_id');
    }
}
