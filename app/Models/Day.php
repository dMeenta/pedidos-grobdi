<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    protected $table = 'day';
    public $timestamps = false;
    public function doctors()
    {
        return $this->belongsToMany(Doctor::class, 'doctor_day');
    }
}
