<?php

namespace App\Http\Controllers\pedidos\counter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Pedidos;
class HistorialPedidosController extends Controller
{
    public function index(Request $request)
    {
        if($request->query("fecha_inicio")){
            $request->validate([
                'fecha_inicio' => 'required|date',
                'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            ]);
            $fechaInicio = Carbon::parse($request->fecha_inicio)->startOfDay();
            $fechaFin = Carbon::parse($request->fecha_fin)->endOfDay();
        
            // Realizar la búsqueda en la base de datos
            $pedidos = Pedidos::whereBetween('deliveryDate', [$fechaInicio, $fechaFin])
            ->orderBy('created_at','asc')->latest()->paginate(25);

        }else{
            $pedidos = Pedidos::orderBy('created_at','asc')->latest()->paginate(25);

        }
        return view('pedidos.counter.historial_pedido.index', compact('pedidos'))
            ->with('i', (request()->input('page', 1) - 1) * 25);
    }
    public function show($pedido){
        $pedido = Pedidos::find($pedido);
        return view('pedidos.counter.historial_pedido.show', compact('pedido'));
    }
}
