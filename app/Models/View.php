<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    public function module() {
        return $this->belongsTo(Module::class);
    }

    public function roles() {
        return $this->belongsToMany(Role::class, 'roles_views');
    }
}
