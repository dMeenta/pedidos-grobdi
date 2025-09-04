<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidosDeliveryState extends Model
{
    protected $table = 'pedidos_delivery_state';

    protected $fillable = [
        'pedido_id',
        'state',
        'motorizado_id',
        'observacion'
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedidos::class);
    }

    public function location()
    {
        return $this->morphOne(Location::class, 'locationable');
    }
}
