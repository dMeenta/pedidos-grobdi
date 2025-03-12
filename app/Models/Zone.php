<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    protected $fillable = [
        'name',
        'description',
        'confirmed',
    ];
    public function pedidos()
    {
        return $this->hasMany(Pedidos::class); 
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_zones'); 
    }
    public $timestamps = false;

}
