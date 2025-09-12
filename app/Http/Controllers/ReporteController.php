<?php

namespace App\Http\Controllers;

use App\Services\Reportes\VentasReporteService;
use App\Services\Reportes\DoctoresReporteService;
use App\Services\Reportes\VisitadorasReporteService;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function __construct(
        protected VentasReporteService $ventasService,
        protected DoctoresReporteService $doctoresService,
        protected VisitadorasReporteService $visitadorasService
    ) {}

    public function ventas(Request $request)
    {
        $filtros = $request->only(['mes_general', 'anio_general']);
        $data = $this->ventasService->getData($filtros);
        
        return view('reporte.ventas', ['data' => $data->toArray()]);
    }

    public function apiVentas(Request $request)
    {
        $filtros = $request->only(['mes_general', 'anio_general']);
        $data = $this->ventasService->getData($filtros);
        
        return response()->json($data->toArray());
    }

    public function doctores(Request $request)
    {
       
        return view('reporte.doctores');
    }

    public function visitadoras(Request $request)
    {
        return view('reporte.visitadoras');
    }

}
