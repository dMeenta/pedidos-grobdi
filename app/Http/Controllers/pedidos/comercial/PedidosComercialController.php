<?php

namespace App\Http\Controllers\pedidos\comercial;

use App\Application\Services\PedidosComercial\PedidosComercialService;
use App\Exports\PedidosComercial\PedidosComercialExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\pedidos\comercial\PedidosComercialFilterRequest;
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
        $filters = $this->service->sanitizeFilters($request->validated());
        $pedidos = $this->service->getListado($filters, 25);
        $pedidos->appends($filters);

        return view('pedidos.comercial.index', [
            'pedidos' => $pedidos,
            'filters' => $filters,
        ]);
    }

    public function export(PedidosComercialFilterRequest $request): BinaryFileResponse
    {
        $filters = $this->service->sanitizeFilters($request->validated());
        $pedidos = $this->service->getListadoExport($filters);
        $filename = 'pedidos-comercial-' . now()->format('Ymd_His') . '.xlsx';

        return Excel::download(new PedidosComercialExport($pedidos), $filename);
    }
}
