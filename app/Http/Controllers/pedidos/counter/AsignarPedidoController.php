<?php

namespace App\Http\Controllers\pedidos\counter;

use App\Http\Controllers\Controller;
<<<<<<< HEAD
use App\Services\PedidoAssignmentService;
=======
use App\Application\Services\PedidoAssignmentService;
>>>>>>> f76f4ac7a11c11334cc0a0e9b770a16c887d9683
use Illuminate\Http\Request;

class AsignarPedidoController extends Controller
{
    protected $pedidoAssignmentService;

    public function __construct(PedidoAssignmentService $pedidoAssignmentService)
    {
        $this->pedidoAssignmentService = $pedidoAssignmentService;
    }

    public function index(Request $request)
    {
        $zonas = $this->pedidoAssignmentService->getZonas();
        $pedidos = $this->pedidoAssignmentService->getPedidosForDate($request->query("fecha"));
        return view('pedidos.counter.asignar_pedido.index', compact("zonas", "pedidos"));
    }

    public function update(Request $request, $id)
    {
        $this->pedidoAssignmentService->assignZoneToPedido($id, $request->zone_id);
        return back()->with('success', 'Pedido modificado exitosamente');
<<<<<<< HEAD
=======
    }

    public function show($pedido)
    {
        $pedido = $this->pedidoAssignmentService->getPedidoById($pedido);
        return view('pedidos.counter.asignar_pedido.index', compact('pedido'));
>>>>>>> f76f4ac7a11c11334cc0a0e9b770a16c887d9683
    }
}
