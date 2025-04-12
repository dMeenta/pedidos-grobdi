<?php

namespace App\Http\Controllers\rutas\enrutamiento;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AsignacionSemanal extends Controller
{
    public function mostrarDiasDelMes()
    {
        // Obtener el primer día del mes actual
        $inicioMes = Carbon::now()->startOfMonth();

        // Obtener el último día del mes actual
        $finMes = Carbon::now()->endOfMonth();

        // Arreglo para almacenar las semanas
        $semanas = [];
        $semana = [];

        // Calcular el primer día de la semana (por ejemplo, lunes)
        $primerDiaSemana = $inicioMes->copy()->startOfWeek();  // El primer día de la semana es lunes
        
        // Agregar los días vacíos antes del primer día del mes
        // Si el mes no comienza en lunes, rellena con días vacíos hasta llegar al primer día del mes
        for ($dia = $primerDiaSemana; $dia->lt($inicioMes); $dia->addDay()) {
            $semana[] = null; // Representamos los días vacíos con null
        }

        // Iterar sobre todos los días del mes
        for ($dia = $inicioMes->copy(); $dia <= $finMes; $dia->addDay()) {
            // Agregar el día al arreglo de la semana
            $semana[] = $dia->copy();

            // Si es domingo (fin de semana), almacenar la semana y reiniciar el arreglo
            if ($dia->isSunday()) {
                $semanas[] = $semana;
                $semana = []; // Reiniciar la semana
            }
        }

        // Si la última semana no ha sido agregada (en caso de que no termine en domingo)
        if (count($semana) > 0) {
            $semanas[] = $semana;
        }
        // dd($semanas);
        // Pasamos los días y las semanas a la vista
        return view('rutas.enrutamiento.index2', compact('semanas'));
    }
}
