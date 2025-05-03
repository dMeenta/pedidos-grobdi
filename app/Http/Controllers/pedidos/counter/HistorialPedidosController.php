<?php

namespace App\Http\Controllers\pedidos\counter;

use App\Http\Controllers\Controller;
use App\Models\DetailPedidos;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Pedidos;
class HistorialPedidosController extends Controller
{
    public function index(Request $request)
    {
        $ordenarPor = $request->get('sort_by', 'orderId'); // campo por defecto
        $direccion = $request->get('direction', 'asc'); 
        if($request->query("fecha_inicio")){
            $request->validate([
                'fecha_inicio' => 'required|date',
                'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            ]);
            $fechaInicio = Carbon::parse($request->fecha_inicio)->startOfDay();
            $fechaFin = Carbon::parse($request->fecha_fin)->endOfDay();
        
            // Realizar la búsqueda en la base de datos
            $pedidos = Pedidos::whereBetween('deliveryDate', [$fechaInicio, $fechaFin])
            ->orderBy($ordenarPor, $direccion)
            ->latest()
            ->paginate(25);

        }else if($request->query("buscar")){
            $pedidos = Pedidos::where('orderId',$request->buscar)
            ->orWhere('customerName','like','%'.$request->buscar.'%')
            ->orderBy($ordenarPor, $direccion)
            ->latest()
            ->paginate(25);
        }else{
            $pedidos = Pedidos::where('deliveryDate',date('Y-m-d'))
            ->orderBy($ordenarPor, $direccion)
            ->latest()
            ->paginate(25);
        }
        return view('pedidos.counter.historial_pedido.index', compact('pedidos', 'ordenarPor', 'direccion'));
    }
    public function show($pedido){
        $pedido = Pedidos::find($pedido);
        return view('pedidos.counter.historial_pedido.show', compact('pedido'));
    }
    public function update($id,Request $request){
        $detailpedido = DetailPedidos::find($id);
        $detailpedido->cantidad = $request->cantidad;
        $sub_total_actual = $request->cantidad * $detailpedido->unit_prize;
        $diferencia = $sub_total_actual - $detailpedido->sub_total;
        $detailpedido->sub_total = $sub_total_actual;
        $detailpedido->save();
        $pedido = Pedidos::find($detailpedido->pedidos_id);
        $pedido->prize += $diferencia;
        $pedido->save();
        return response()->json(['success' => true]);
    }
    public function destroy($id_detailpedido){
        $detailpedido = DetailPedidos::find($id_detailpedido);
        $pedido = Pedidos::find($detailpedido->pedidos_id);
        $pedido->prize=$pedido->prize-$detailpedido->sub_total;
        $pedido->save();
        $detailpedido->delete();
        return back()->with('success','producto eliminado correctamente');
    }
}
