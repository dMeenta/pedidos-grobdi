<?php

namespace Database\Seeders;

use App\Models\ClasificacionPresentacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClasificacionPresentacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClasificacionPresentacion::create(['quantity' => '30', 'clasificacion_id' => 1]);
        ClasificacionPresentacion::create(['quantity' => '30', 'clasificacion_id' => 2]);
        ClasificacionPresentacion::create(['quantity' => '7', 'clasificacion_id' => 3]);
        ClasificacionPresentacion::create(['quantity' => '10', 'clasificacion_id' => 3]);
        ClasificacionPresentacion::create(['quantity' => '10', 'clasificacion_id' => 4]);
        ClasificacionPresentacion::create(['quantity' => '60', 'clasificacion_id' => 5]);
        ClasificacionPresentacion::create(['quantity' => '150', 'clasificacion_id' => 5]);
        ClasificacionPresentacion::create(['quantity' => '10', 'clasificacion_id' => 6]);
        ClasificacionPresentacion::create(['quantity' => '11', 'clasificacion_id' => 6]);
        ClasificacionPresentacion::create(['quantity' => '20', 'clasificacion_id' => 6]);
        ClasificacionPresentacion::create(['quantity' => '30', 'clasificacion_id' => 6]);
        ClasificacionPresentacion::create(['quantity' => '10', 'clasificacion_id' => 7]);
        ClasificacionPresentacion::create(['quantity' => '20', 'clasificacion_id' => 7]);
        ClasificacionPresentacion::create(['quantity' => '30', 'clasificacion_id' => 7]);
        ClasificacionPresentacion::create(['quantity' => '50', 'clasificacion_id' => 7]);
        ClasificacionPresentacion::create(['quantity' => '60', 'clasificacion_id' => 7]);
        ClasificacionPresentacion::create(['quantity' => '100', 'clasificacion_id' => 7]);
        ClasificacionPresentacion::create(['quantity' => '10', 'clasificacion_id' => 8]);
        ClasificacionPresentacion::create(['quantity' => '20', 'clasificacion_id' => 8]);
        ClasificacionPresentacion::create(['quantity' => '150', 'clasificacion_id' => 9]);
        ClasificacionPresentacion::create(['quantity' => '250', 'clasificacion_id' => 9]);
        ClasificacionPresentacion::create(['quantity' => '500', 'clasificacion_id' => 9]);
        ClasificacionPresentacion::create(['quantity' => '1000', 'clasificacion_id' => 9]);
        ClasificacionPresentacion::create(['quantity' => '10', 'clasificacion_id' => 10]);
        ClasificacionPresentacion::create(['quantity' => '15', 'clasificacion_id' => 10]);
        ClasificacionPresentacion::create(['quantity' => '20', 'clasificacion_id' => 10]);
        ClasificacionPresentacion::create(['quantity' => '30', 'clasificacion_id' => 10]);
        //Solución oral preguntar
        ClasificacionPresentacion::create(['quantity' => '10', 'clasificacion_id' => 11]);
        ClasificacionPresentacion::create(['quantity' => '20', 'clasificacion_id' => 11]);
        ClasificacionPresentacion::create(['quantity' => '30', 'clasificacion_id' => 11]);
        ClasificacionPresentacion::create(['quantity' => '50', 'clasificacion_id' => 11]);
        ClasificacionPresentacion::create(['quantity' => '60', 'clasificacion_id' => 11]);
        ClasificacionPresentacion::create(['quantity' => '100', 'clasificacion_id' => 11]);
        //
        ClasificacionPresentacion::create(['quantity' => '100', 'clasificacion_id' => 12]);
        ClasificacionPresentacion::create(['quantity' => '150', 'clasificacion_id' => 12]);
        ClasificacionPresentacion::create(['quantity' => '500', 'clasificacion_id' => 12]);
        ClasificacionPresentacion::create(['quantity' => '1000', 'clasificacion_id' => 12]);
        ClasificacionPresentacion::create(['quantity' => '100', 'clasificacion_id' => 13]);
        ClasificacionPresentacion::create(['quantity' => '150', 'clasificacion_id' => 13]);
        ClasificacionPresentacion::create(['quantity' => '500', 'clasificacion_id' => 13]);
        ClasificacionPresentacion::create(['quantity' => '1000', 'clasificacion_id' => 13]);
        ClasificacionPresentacion::create(['quantity' => '30', 'clasificacion_id' => 14]);
        ClasificacionPresentacion::create(['quantity' => '50', 'clasificacion_id' => 14]);
        ClasificacionPresentacion::create(['quantity' => '30', 'clasificacion_id' => 15]);
        ClasificacionPresentacion::create(['quantity' => '50', 'clasificacion_id' => 15]);
        ClasificacionPresentacion::create(['quantity' => '30', 'clasificacion_id' => 16]);
        ClasificacionPresentacion::create(['quantity' => '50', 'clasificacion_id' => 16]);
        ClasificacionPresentacion::create(['quantity' => '150', 'clasificacion_id' => 17]);
        ClasificacionPresentacion::create(['quantity' => '250', 'clasificacion_id' => 17]);
        ClasificacionPresentacion::create(['quantity' => '500', 'clasificacion_id' => 17]);
        ClasificacionPresentacion::create(['quantity' => '1000', 'clasificacion_id' => 17]);
    }
}
