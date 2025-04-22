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

}
