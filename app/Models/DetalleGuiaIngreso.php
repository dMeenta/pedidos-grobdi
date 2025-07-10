<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleGuiaIngreso extends Model
{
    use HasFactory;

    protected $table = 'detalle_guia_ingreso';
    protected $fillable = [
        'guia_ingreso_id',
        'lote_id',
        'fecha_vencimiento',
        'cantidad',
        'detalle_compra_id',
    ];

    public function guiaIngreso()
    {
        return $this->belongsTo(GuiaIngreso::class);
    }

    public function lote()
    {
        return $this->belongsTo(Lote::class);
    }

    public function detalleCompra()
    {
        return $this->belongsTo(DetalleCompra::class);
    }
}
