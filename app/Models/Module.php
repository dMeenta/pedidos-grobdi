<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    public function views() {
        return $this->hasMany(View::class);
    }

    public function roles() {
        return $this->belongsToMany(Role::class, 'roles_modules');
    }
}
