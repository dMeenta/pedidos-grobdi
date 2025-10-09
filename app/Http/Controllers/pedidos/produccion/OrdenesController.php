<?php

namespace App\Http\Controllers\pedidos\produccion;

use App\Http\Controllers\Controller;
use App\Models\DetailPedidos;
use App\Models\PresentacionFarmaceutica;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OrdenesController extends Controller
{
    public function index(Request $request){
        // $fecha = "";
        if(isset($request->fecha_produccion)){

            $fecha = Carbon::parse($request->fecha_produccion)->startOfDay();
            // dd($fecha);
        }else{
            $fecha = date('Y-m-d');
        }
        $detallepedidos = DetailPedidos::where('status', true)
        ->whereHas('pedido', function ($query) use($fecha) {
            $query->whereDate('deliveryDate', $fecha);
        })
        ->where('usuario_produccion_id',Auth::user()->id)
        ->where('articulo', 'not like', '%bolsa%')
        ->where('articulo', 'not like', '%delivery%')->get();

        $presentacion_farmaceutica = PresentacionFarmaceutica::all();
        foreach ($detallepedidos as $detalle) {
            $detalle->bases = null; // por defecto
            $detalle->contenido = null;

            foreach ($presentacion_farmaceutica as $presentacion) {
                if (stripos($detalle->articulo, $presentacion->name) !== false) {
                    $detalle->bases = $presentacion->name;
                    $detalle->contenido = $presentacion->bases;
                    // Expresión regular para capturar nombre + número + unidad
                    preg_match_all('/(.*?)(\d+)(MG|UI|ML|%)/i', $detalle->articulo, $matches, PREG_SET_ORDER);

                    $componentes = [];

                    foreach ($matches as $match) {
                        $nombre = trim($match[1]);
                        $cantidad = (int) $match[2];
                        $unidad = strtoupper($match[3]);

                        $componentes[] = [
                            'nombre'   => $nombre,
                            'cantidad' => $cantidad,
                            'unidad'   => $unidad,
                        ];
                    }
                    // dd($componentes[0]['nombre']);
                    //Al primer array reemplaza los valores de la clasificacion y el " DE0"
                    if(isset($componentes[0]['nombre'])){
                        $componentes[0]['nombre'] = str_replace([' DE ',$presentacion->name],'',$componentes[0]['nombre']);
                        // dd($componentes[0]['nombre']);
                    }
                    $detalle->ingredientes = $componentes;
                    // dd($detalle->ingredientes);
                    // dd($detalle->articulo);
                    break; // si encuentra uno, sale
                }
            }
        }
        return view('pedidos.produccion.index',compact('detallepedidos'));
    }

    public function actualizarEstado(Request $request, $detalleId){
        $detallePedido = DetailPedidos::findOrFail($detalleId);
        $detallePedido->estado_produccion = 1;
        // dd($request->all());


        $imgData = $request->input('imagen');
        $img = str_replace('data:image/png;base64,', '', $imgData);
        $img = str_replace(' ', '+', $img);
        $imageName = 'firma_' . $detalleId . '_' . time() . '.png';

        Storage::disk('public')->put("firmas_produccion/{$imageName}", base64_decode($img));
        
        $detallePedido->save();
        return response()->json([
            'success' => true,
            'mensaje' => 'Estado actualizado correctamente',
            'nuevo_estado' => 'Completado'
        ]);

    }
}
