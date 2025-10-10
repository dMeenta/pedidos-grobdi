<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VisitaDoctor extends Model
{

    /**
     * The attributes that are mass assignable.
     * Modificar según necesidad 😊
     * @var array
     */
    protected $fillable = [
        'doctor_id',
        'enrutamientolista_id',
        'fecha',
        'estado_visita_id',
        'created_by',
        'updated_by'
    ];

    // 0 = mañana, 1 = tarde
    protected $table = 'visita_doctor';

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function estado_visita()
    {
        return $this->belongsTo(EstadoVisita::class);
    }
    public function enrutamientolista()
    {
        return $this->belongsTo(EnrutamientoLista::class, 'enrutamientolista_id');
    }
    public function distrito()
    {
        return $this->hasOneThrough(
            Distrito::class,
            Doctor::class,
            'id',
            'id',
            'doctor_id',
            'distrito_id'
        );
    }
}
