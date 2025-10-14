<?php

namespace App\Http\Controllers\pedidos\comercial;

use App\Application\Services\PedidosComercial\PedidosComercialService;
use App\Exports\PedidosComercial\PedidosComercialExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\pedidos\comercial\PedidosComercialFilterRequest;
use App\Models\Doctor;
use App\Models\Distrito;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PedidosComercialController extends Controller
{
    public function __construct(
        protected PedidosComercialService $service
    ) {
    }

    public function index(PedidosComercialFilterRequest $request)
    {
        $filters = $this->applyDefaultDateFilters(
            $this->service->sanitizeFilters($request->validated())
        );
        $pedidos = $this->service->getListado($filters, 25);
        $pedidos->appends($filters);

        return view('pedidos.comercial.index', [
            'pedidos' => $pedidos,
            'filters' => $filters,
            'doctorOptions' => $this->getDoctorOptions(),
            'distritoOptions' => $this->getDistritoOptions(),
        ]);
    }

    public function export(PedidosComercialFilterRequest $request): BinaryFileResponse
    {
        $filters = $this->applyDefaultDateFilters(
            $this->service->sanitizeFilters($request->validated())
        );
        $pedidos = $this->service->getListadoExport($filters);
        $filename = 'pedidos-comercial-' . now()->format('Ymd_His') . '.xlsx';

        return Excel::download(new PedidosComercialExport($pedidos), $filename);
    }

    protected function applyDefaultDateFilters(array $filters): array
    {
        if (!isset($filters['fecha_inicio']) && !isset($filters['fecha_fin'])) {
            $today = now()->toDateString();
            $filters['fecha_inicio'] = $today;
            $filters['fecha_fin'] = $today;
        }

        return $filters;
    }

    protected function getDoctorOptions()
    {
        return Doctor::orderBy('name')->get(['id', 'name']);
    }

    protected function getDistritoOptions()
    {
        return Distrito::whereIn('provincia_id', [67, 128])
            ->orderBy('name')
            ->get(['id', 'name']);
    }
}
