<?php

namespace Database\Seeders;

use App\Models\CategoriaDoctor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaDoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            ['name'=>'AAA','prioridad'=>1,'monto'=>15.000],
            ['name'=>'AA','prioridad'=>2,'monto'=>1],
            ['name'=>'A','prioridad'=>3,'monto'=>1],
            ['name'=>'B','prioridad'=>4,'monto'=>1],
            ['name'=>'C','prioridad'=>5,'monto'=>1]
            ];
            
            foreach ($categorias as $cat) {
                CategoriaDoctor::create($cat);
            }
    }
}
