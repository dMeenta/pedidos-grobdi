<?php

namespace App\Http\Controllers\pedidos\Motorizado;

use App\Events\PedidosNotification;
use App\Http\Controllers\Controller;
use App\Models\Pedidos;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Laravel\Facades\Image;
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
        // dd($pedidos);
        // Dispatch the event with the post data
        event(new PedidosNotification([
            'orderId' => $pedidos->orderId,
            'estado_entrega' => $pedidos->deliveryStatus,
            'detalles_motorizado' => $pedidos->detailMotorizado,
            'nombre_usuario' => Auth::user()->name
        ]));
        return redirect()->route('pedidosmotorizado.index')
                        ->with('success','Pedido modificado exitosamente');
    }
    public function cargarFotos(Request $request ,$id){

        $pedidos = Pedidos::find($id);
        
        if($request->fotoDomicilio){
			$imagen = $request->file("fotoDomicilio");
			$img_ext = explode(".",$imagen->getClientOriginalName());
			$extension = '.'.$img_ext[1];
            $imageNameDomicilio = $pedidos->orderId.'_'.time().$extension;
			//$imageNameReceta = time().'.'.$request->receta->extension();
            $img = Image::read($imagen->getRealPath());

            // Redimensionar la imagen
            $img->resize(800, 700, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        	$path = public_path('images/fotoDomicilio/'.$imageNameDomicilio);
            $img->save($path);
            $pedidos->fotoDomicilio = 'images/fotoDomicilio/'.$imageNameDomicilio;
            $pedidos->fechaFotoDomicilio = now();
            $pedidos->save();
        }
        if($request->fotoEntrega){
			$imagen = $request->file("fotoEntrega");
			$img_ext = explode(".",$imagen->getClientOriginalName());
			$extension = '.'.$img_ext[1];
            $imageNameEntrega = $pedidos->orderId.'_'.time().$extension;
			//$imageNameReceta = time().'.'.$request->receta->extension();
            $img = Image::read($imagen->getRealPath());

            // Redimensionar la imagen
            $img->resize(800, 700, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $path = public_path('images/fotos_entrega/'.$imageNameEntrega);
            $img->save($path);
            $pedidos->fotoEntrega = 'images/fotos_entrega/'.$imageNameEntrega;
            $pedidos->fechaFotoEntrega = now();
            $pedidos->save();
        }
        
        return back()->with('success','Pedido modificado exitosamente');
    }
}
