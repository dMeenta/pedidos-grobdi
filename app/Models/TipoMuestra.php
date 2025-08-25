<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoMuestra extends Model
{
    /** @use HasFactory<\Database\Factories\TipoMuestraFactory> */
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function muestras()
    {
        return $this->hasMany(Muestras::class, 'id_muestra');
    }
}
