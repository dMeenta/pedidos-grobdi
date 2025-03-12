<?php

namespace App\Http\Controllers\pedidos\Motorizado;

use App\Http\Controllers\Controller;
use App\Models\Pedidos;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidosMotoController extends Controller
{
    public function index(Request $request){
        $user_id = Auth::user()->id;
        $user = User::with('zones')->where('id', $user_id)->get();
        $zonas = [];
        foreach ($user[0]->zones as $zone) {
            $zonas[] = $zone->id;
        }
        if($request->query("fecha")){
            $request->validate([
                'fecha' => 'required|date'
            ]);
            $fecha = Carbon::parse($request->fecha)->startOfDay();
        
        }else{
            $fecha = date('Y-m-d');
        }
        $pedidos_zona = Pedidos::whereIn("zone_id", $zonas)->where('deliveryDate',$fecha)->get();
        return view('pedidos.motorizado.pedidos.index', compact("pedidos_zona"))->with('i',0);
    }
    public function edit($pedido){
        $pedido = Pedidos::find($pedido);
        // dd($pedido->deliveryStatus);
        return view('pedidos.motorizado.pedidos.edit',compact('pedido'));
    }
    public function update(Request $request, $id)
    {
        // dd(request()->all());
        $pedidos = Pedidos::find($id);
        $pedidos->deliveryStatus = $request->deliveryStatus;
        $pedidos->detailMotorizado = $request->detailMotorizado;
        $pedidos->user_id = Auth::user()->id;
        $pedidos->save();
          
        return redirect()->route('pedidosmotorizado.index')
                        ->with('success','Pedido modificado exitosamente');
    }
}