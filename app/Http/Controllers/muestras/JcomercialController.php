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

class JcomercialController extends Controller
{
    
    public function confirmar()
    {
        $muestras = Muestras::with(['clasificacion.unidadMedida'])->paginate(10);
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
