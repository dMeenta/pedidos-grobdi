<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use  App\Models\Module;
class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = [
            ['name'=>'admin','description'=>'modulo del administrador'],
            ['name'=>'counter','description'=>'modulo del counter'],
            ['name'=>'contabilidad','description'=>'modulo de contabilidad'],
            ['name'=>'laboratorio','description'=>'modulo de laboratorio'],
            ['name'=>'motorizado','description'=>'modulo de motorizado']
            ];
            
            foreach ($modules as $module) {
                Module::create($module);
            }
    }
}
