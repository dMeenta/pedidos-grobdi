<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrutamiento extends Model
{
    protected $table = 'enrutamiento';

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }
    public function enrutamiento_listas()
    {
        return $this->hasMany(EnrutamientoLista::class);
    }
}
