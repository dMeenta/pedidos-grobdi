<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClasificacionPresentacion extends Model
{
    protected $fillable = [
        'quantity',
        'clasificacion_id'
    ];

    protected $table = 'clasificacion_presentaciones';

    public function clasificacion()
    {
        return $this->belongsTo(Clasificacion::class);
    }
    public function muestras()
    {
        return $this->hasMany(Muestras::class);
    }
}
