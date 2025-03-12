<?php

namespace App\Http\Controllers\pedidos\counter;

use App\Http\Controllers\Controller;
use App\Models\Pedidos;
use Illuminate\Http\Request;
use App\Models\Zone ;
use Carbon\Carbon;

class AsignarPedidoController extends Controller
{
    public function index(Request $request) {
        $zonas = Zone::orderBy('id','desc')->get()   ;
        
        if($request->query("fecha")){
            $request->validate([
                'fecha' => 'required|date'
            ]);
            $dia = Carbon::parse($request->fecha)->startOfDay();
        }else{
            $dia = now()->format('Y-m-d');
        }
        $pedidos = Pedidos::whereDate('deliveryDate', $dia)->get();
        return view('pedidos.counter.asignar_pedido.index', compact("zonas","pedidos"));
    }
    public function update(Request $request, $id)
    {
        $pedidos = Pedidos::find($id);
        $pedidos->zone_id = $request ->zone_id;
        $pedidos->save() ;
        // dd($pedidos) ;
        return back()->with('success','Pedido modificado exitosamente');
    }
    public function show($pedido){
        $pedido = Pedidos::find($pedido);
        return view('pedidos.counter.asignar_pedido.index', compact('pedido'));
    }
}
