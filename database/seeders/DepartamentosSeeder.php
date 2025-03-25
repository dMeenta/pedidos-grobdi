<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Departamento;
class DepartamentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departamentos = [
            ['name'=>'AMAZONAS'],
            ['name'=>'ANCASH'],
            ['name'=>'APURIMAC'],
            ['name'=>'AREQUIPA'],
            ['name'=>'AYACUCHO'],
            ['name'=>'CAJAMARCA'],
            ['name'=>'CALLAO'],
            ['name'=>'CUSCO'],
            ['name'=>'HUANCAVELICA'],
            ['name'=>'HUANUCO'],
            ['name'=>'ICA'],
            ['name'=>'JUNIN'],
            ['name'=>'LA LIBERTAD'],
            ['name'=>'LAMBAYEQUE'],
            ['name'=>'LIMA'],
            ['name'=>'LORETO'],
            ['name'=>'MADRE DE DIOS'],
            ['name'=>'MOQUEGUA'],
            ['name'=>'PASCO'],
            ['name'=>'PIURA'],
            ['name'=>'PUNO'],
            ['name'=>'SAN MARTIN'],
            ['name'=>'TACNA'],
            ['name'=>'TUMBES'],
            ['name'=>'UCAYALI']
            ];
            
            foreach ($departamentos as $departamento) {
                Departamento::create($departamento);
            }
    }
}
