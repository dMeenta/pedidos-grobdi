<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lista extends Model
{
    protected $table = 'lista';
    protected $fillable = [
        'name',
        'zone_id',
        'recovery'
    ];
    public function distritos()
    {
        return $this->belongsToMany(Distrito::class, 'lista_distrito');
    }
    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }
}
