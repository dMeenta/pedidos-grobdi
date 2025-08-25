<?php

namespace App\Http\Controllers\muestras;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Muestras;
use App\Models\UnidadMedida;
use App\Models\Clasificacion;
//formatear
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MuestrasExport;

class JcomercialController extends Controller
{
    public function exportarExcel(Request $request)
    {
        $muestras = Muestras::with(['clasificacion', 'creator'])
            ->orderByDesc('created_at')
            ->get();

        return \Excel::download(
            new \App\Exports\muestras\MuestrasExport($muestras, [
                'Nombre de la Muestra',
                'Clasificación',
                'Tipo de Muestra',
                'Día de Entrega',
                'Doctor',
                'Creado por'
            ]),
            'muestras_jcomercial.xlsx'
        );
    }
    public function confirmar()
    {
        $muestras = Muestras::with(['clasificacion.unidadMedida'])->orderBy('created_at', 'desc')->get();
        return view('muestras.Jcomercial.confirmar', compact('muestras'));
    }

    public function showJC($id)
    {
        // Cargar la muestra con su clasificación y la unidad de medida asociada
        $muestra = Muestras::with(['clasificacion.unidadMedida'])->findOrFail($id);

        // Retornar la vista de "Detalles de Muestra" con los datos
        return view('muestras.Jcomercial.showJC', compact('muestra'));
    }
}
