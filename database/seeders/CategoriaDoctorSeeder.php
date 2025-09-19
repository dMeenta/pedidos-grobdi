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
            ['name'=>'AAA','prioridad'=>1,'monto_inicial'=>15.00,'monto_final'=>20.00],
            ['name'=>'AA','prioridad'=>2,'monto_inicial'=>10.00,'monto_final'=>15.00],
            ['name'=>'A','prioridad'=>3,'monto_inicial'=>8.00,'monto_final'=>12.00],
            ['name'=>'B','prioridad'=>4,'monto_inicial'=>5.00,'monto_final'=>8.00],
            ['name'=>'C','prioridad'=>5,'monto_inicial'=>2.00,'monto_final'=>5.00]
            ];
            
            foreach ($categorias as $cat) {
                CategoriaDoctor::create($cat);
            }
    }
}
