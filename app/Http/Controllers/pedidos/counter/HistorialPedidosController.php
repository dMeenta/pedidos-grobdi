<?php

namespace App\Http\Controllers\pedidos\counter;

use App\Http\Controllers\Controller;
use App\Application\Services\PedidoHistoryService;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Pedidos;

class HistorialPedidosController extends Controller
{
    protected $pedidoHistoryService;

    public function __construct(PedidoHistoryService $pedidoHistoryService)
    {
        $this->pedidoHistoryService = $pedidoHistoryService;
    }

    public function index(Request $request)
    {
        $pedidos = $this->pedidoHistoryService->getPedidos($request);
        $ordenarPor = $request->get('sort_by', 'orderId');
        $direccion = $request->get('direction', 'asc');
        return view('pedidos.counter.historial_pedido.index', compact('pedidos', 'ordenarPor', 'direccion'));
    }

    public function show($pedido)
    {
        $pedido = Pedidos::find($pedido);
        return view('pedidos.counter.historial_pedido.show', compact('pedido'));
    }

    public function update($id, Request $request)
    {
        return $this->pedidoHistoryService->updateDetailPedido($id, $request);
    }

    public function destroy($id_detailpedido)
    {
        return $this->pedidoHistoryService->destroyDetailPedido($id_detailpedido);
    }
}
