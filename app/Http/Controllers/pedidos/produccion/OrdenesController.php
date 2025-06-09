<?php

namespace App\Http\Controllers\pedidos\produccion;

use App\Http\Controllers\Controller;
use App\Models\DetailPedidos;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OrdenesController extends Controller
{
    public function index(){

        $detallepedidos = DetailPedidos::whereHas('pedido', function ($query) {
            $query->whereDate('deliveryDate', Carbon::parse('14-04-2025')->startOfDay());
        })
        ->where('usuario_produccion_id',Auth::user()->id)
        ->where('articulo', 'not like', '%bolsa%')
        ->where('articulo', 'not like', '%delivery%')->get();
        return view('pedidos.produccion.index',compact('detallepedidos'));
    }

    public function actualizarEstado(Request $request, $detalleId){
        $detallePedido = DetailPedidos::findOrFail($detalleId);
        $detallePedido->estado_produccion = $request->estado;
        // dd($request->all());


        $imgData = $request->input('imagen');
        $img = str_replace('data:image/png;base64,', '', $imgData);
        $img = str_replace(' ', '+', $img);
        $imageName = 'firma_' . $detalleId . '_' . time() . '.png';

        Storage::disk('public')->put($imageName, base64_decode($img));

        $detallePedido->save();

        return response()->json([
            'success' => true,
            'mensaje' => 'Estado actualizado correctamente',
            'data' => $request->all(),
            'nuevo_estado' => 'Completado'
        ]);
    }
}
