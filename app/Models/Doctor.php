<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table = 'doctor';

    protected $fillable = [
        'especialidad_id',
        'name_secretariat',
    ];
    public const TIPOMEDICO = [
        'Comprador','Prescriptor','En Proceso'
    ];
    public function days()
    {
        return $this->belongsToMany(day::class, 'doctor_day');
    }
    public function distrito()
    {
        return $this->belongsTo(Distrito::class);
    }
    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class);
    }
    public function centrosalud()
    {
        return $this->belongsTo(CentroSalud::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
