<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
class RoleSeeder extends Seeder
{
    public function run(): void
    {

        $roles = [
            ['name'=>'admin','description'=>'rol de administrador'],
            ['name'=>'counter','description'=>'rol de counter'],
            ['name'=>'contabilidad','description'=>'rol de contabilidad'],
            ['name'=>'laboratorio','description'=>'rol de laboratorio'],
            ['name'=>'motorizado','description'=>'rol de motorizado'],
            ['name'=>'visitador','description'=>'rol de visitador medico'],
            ['name'=>'jefe-operaciones','description'=>'rol de jefe de operaciones'],
            ['name'=>'jefe-comercial','description'=>'rol de jefe comercial'],
            ['name'=>'coordinador-lineas','description'=>'rol de coordinador de lineas'],
            ['name'=>'gerencia-general','description'=>'rol de gerencia general'],
            ['name'=>'supervisor','description'=>'rol de supervisor'],
        ];
            
            foreach ($roles as $role) {
                Role::create($role);
            }
    }
}
