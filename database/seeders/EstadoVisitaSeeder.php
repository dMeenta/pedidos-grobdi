<?php

namespace Database\Seeders;

use App\Models\EstadoVisita;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadoVisitaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $esta_visitas = [
            ['name'=>'No asignado'],
            ['name'=>'visitado'],
            ['name'=>'No visitado'],
            ['name'=>'Asignado'],
            ['name'=>'Repogramado'],
            ];
            
            foreach ($esta_visitas as $estado_visita) {
                EstadoVisita::create($estado_visita);
            }
    }
}
