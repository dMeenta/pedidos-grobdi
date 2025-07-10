<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuiaIngreso extends Model
{
    use HasFactory;

    protected $table = 'guia_ingreso';
    protected $fillable = [
        'nombre',
        'fecha',
        'compra_id',
    ];

    public function compra()
    {
        return $this->belongsTo(Compra::class);
    }

    public function detalles()
    {
        return $this->hasMany(DetalleGuiaIngreso::class);
    }
}
