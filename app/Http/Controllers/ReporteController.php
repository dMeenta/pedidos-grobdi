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
        $filtros = $request->only([
            'mes_general', 
            'anio_general', 
            'fecha_inicio_producto', 
            'fecha_fin_producto'
        ]);
        
        $data = $this->ventasService->getData($filtros);
        
        return response()->json($data->toArray());
    }

    public function doctores(Request $request)
    {
        // Aceptar nuevos filtros de rango de fechas y mantener compatibilidad con antiguos
        $filtros = $request->only([
            'fecha_inicio_tipo_doctor',
            'fecha_fin_tipo_doctor',
            'anio_tipo_doctor', // legacy
            'mes',              // legacy
            'tipo_medico'
        ]);

        $data = $this->doctoresService->getData($filtros);
        return view('reporte.doctores', ['data' => $data->toArray()]);
    }

    public function apiDoctores(Request $request)
    {
        $filtros = $request->only([
            'fecha_inicio_tipo_doctor',
            'fecha_fin_tipo_doctor',
            'anio_tipo_doctor', // legacy
            'mes',              // legacy
            'tipo_medico'
        ]);
        $data = $this->doctoresService->getData($filtros);
        return response()->json($data->toArray());
    }

    public function visitadoras(Request $request)
    {
        return view('reporte.visitadoras');
    }

    public function filtrosDoctores(Request $request)
    {
        return response()->json([
            'anios' => $this->doctoresService->getAniosDisponibles(),
            'tipos_medico' => $this->doctoresService->getTiposMedicoDisponibles(),
            'meses' => [
                ['value' => 1, 'label' => 'Enero'],
                ['value' => 2, 'label' => 'Febrero'],
                ['value' => 3, 'label' => 'Marzo'],
                ['value' => 4, 'label' => 'Abril'],
                ['value' => 5, 'label' => 'Mayo'],
                ['value' => 6, 'label' => 'Junio'],
                ['value' => 7, 'label' => 'Julio'],
                ['value' => 8, 'label' => 'Agosto'],
                ['value' => 9, 'label' => 'Septiembre'],
                ['value' => 10, 'label' => 'Octubre'],
                ['value' => 11, 'label' => 'Noviembre'],
                ['value' => 12, 'label' => 'Diciembre'],
            ]
        ]);
    }

}
