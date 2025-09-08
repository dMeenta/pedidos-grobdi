<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{

    const UPDATED_AT = null;

    const TYPE_CENTRO_SALUD = 'centro_salud';
    const TYPE_DIRECCION_PEDIDO = 'direccion_pedido';
    const TYPE_FOTO_DOMICILIO = 'foto_domicilio';
    const TYPE_FOTO_ENTREGA = 'foto_entrega';

    public static function tiposValidos(): array
    {
        return [
            self::TYPE_CENTRO_SALUD,
            self::TYPE_DIRECCION_PEDIDO,
            self::TYPE_FOTO_DOMICILIO,
            self::TYPE_FOTO_ENTREGA,
        ];
    }

    use HasFactory;

    protected $fillable = [
        'type',
        'latitude',
        'longitude',
    ];

    public function locationable()
    {
        return $this->morphTo();
    }
}
