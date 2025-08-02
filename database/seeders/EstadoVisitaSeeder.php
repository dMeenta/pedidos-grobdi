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
            ['name'=>'No Asignado','color'=>'#1ae1d2'],
            ['name'=>'Asignado','color'=>'#1a5fe1'],
            ['name'=>'No Visitado','color'=>'#e11a1a'],
            ['name'=>'Visitado','color'=>'#20e11a'],
            ['name'=>'Reprogramado','color'=>'#f1c40f'],
            ];
            
            foreach ($esta_visitas as $estado_visita) {
                EstadoVisita::create($estado_visita);
            }
    }
}
