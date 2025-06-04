<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PresentacionFarmaceutica extends Model
{
    protected $table = 'presentacion_farmaceutica';

    public function bases()
    {
        return $this->hasMany(Bases::class,'presentacionfarmaceutica_id');
    }
}
