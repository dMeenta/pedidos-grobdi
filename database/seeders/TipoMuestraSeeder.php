<?php

namespace Database\Seeders;

use App\Models\TipoMuestra;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoMuestraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoMuestra::create(['name' => 'Preescripción']);
        TipoMuestra::create(['name' => 'Producto Nuevo']);
        TipoMuestra::create(['name' => 'Fidelización']);
    }
}
