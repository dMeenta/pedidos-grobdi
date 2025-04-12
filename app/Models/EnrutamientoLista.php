<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnrutamientoLista extends Model
{
    protected $table = 'enrutamiento_lista';

    public function lista()
    {
        return $this->belongsTo(Lista::class);
    }
    public function enrutamiento()
    {
        return $this->belongsTo(Enrutamiento::class);
    }
}
