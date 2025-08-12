<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VisitaDoctor extends Model
{
    protected $table = 'visita_doctor';
    
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function distrito()
    {
        return $this->belongsTo(Distrito::class);
    }
    public function estado_visita()
    {
        return $this->belongsTo(EstadoVisita::class);
    }
    public function enrutamientolista(){
        return $this->belongsTo(EnrutamientoLista::class,'enrutamientolista_id');
    }
}
