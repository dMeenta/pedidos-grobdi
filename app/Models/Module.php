<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    public function modules() {
        return $this->belongsToMany(Module::class, 'roles_modules');
    }
    public function views() {
        return $this->belongsToMany(View::class, 'roles_views');
    }
}
