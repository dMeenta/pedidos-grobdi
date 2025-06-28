<?php

namespace App\Http\Controllers\pedidos\laboratorio;

use App\Http\Controllers\Controller;
use App\Models\Bases;
use App\Models\DetailPedidos;
use Illuminate\Http\Request;
use App\Models\Pedidos;
use App\Models\PresentacionFarmaceutica;
use App\Models\User;
use App\Models\Zone;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PedidoslabController extends Controller
{
    public function index(Request $request)
    {
        if($request->query("fecha")){
            $request->validate([
                'fecha' => 'required|date'
            ]);
            $fecha = Carbon::parse($request->fecha)->startOfDay();
        }else{
            $fecha = date('Y-m-d');
        }
        if($request->turno){
            $turno = $request->turno;
            $pedidos = Pedidos::where('deliveryDate', $fecha)->where('turno',$turno)->orderBy('nroOrder','asc')
            ->latest()->get();
        }else{
            $turno = 0;
            $pedidos = Pedidos::where('deliveryDate', $fecha)->where('turno',0)->orderBy('nroOrder','asc')
            ->latest()->get();
        }
        return view('pedidos.laboratorio.index', compact('pedidos','turno'));
    }
    
    public function show($id){

        $pedido = Pedidos::with(['detailpedidos' => function ($query) {
            $query->where('articulo', 'not like', '%bolsa%')
                ->where('articulo', 'not like', '%delivery%');
        }])->findOrFail($id);

        $bases = Bases::lista();
        // dd($pedido->detailpedidos);
        $array_pedido = [];
        foreach($pedido->detailpedidos as $detalle){
            foreach ($bases as $base => $contenido) {
                // dd($base);
                if(strpos($detalle->articulo,$base)!==false){
                    // dd($contenido['clasificacion']);
                    array_push($array_pedido,[
                        'articulo'=>$detalle->articulo,
                        'cantidad'=>$detalle->cantidad,
                        'clasificacion'=>$contenido['clasificacion']]);
                }else{
                    $mensaje = "No se encontró base para este producto";
                }
            }
        }
        // dd($array_pedido);
        return response()->json($pedido);
    }
    public function pedidosDetalles(Request $request){
        // dd($request->all());
        $tecnicos_produccion = User::whereHas('role',function($query){
            $query->where('name','like','tecnico_produccion');
        })->get();

        if(isset($request->fecha_produccion)){
            // $fecha = date('2025-04-16');
            $fecha = Carbon::parse($request->fecha_produccion)->startOfDay();
            // dd($fecha);
        }else{
            $fecha = date('Y-m-d');
            // $fecha = date('2025-04-16');
        }
        if($request->presentacion){
            // dd($request->presentacion);
            $detallepedidos = DetailPedidos::whereHas('pedido', function ($query) use($fecha) {
                $query->whereDate('deliveryDate', $fecha);
            })
            ->where('articulo', 'not like', '%bolsa%')
            ->where('articulo', 'like', '%'.$request->presentacion.'%')
            ->where('articulo', 'not like', '%delivery%')->get();
        }else{
            $detallepedidos = DetailPedidos::whereHas('pedido', function ($query) use($fecha) {
                $query->whereDate('deliveryDate', $fecha);
            })
            ->where('articulo', 'not like', '%bolsa%')
            ->where('articulo', 'not like', '%delivery%')->get();
        }
        // dd($detallepedidos);
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
        // foreach($detallepedidos as $detalle){
        //     foreach($detalle->contenido['clasificacion'] as $key =>$clasificacion){

        //         dd($key);
        //     }
        // }
        return view('pedidos.laboratorio.pedidodetalle',compact('detallepedidos','presentacion_farmaceutica','tecnicos_produccion'));

    }
    public function asignarTecnicoProd(Request $request, $id){
        
        $detailPed = DetailPedidos::find($id);
        $detailPed->usuario_produccion_id = $request->usuario_produccion_id;
        $detailPed->save();

        return redirect()->back()->with('success','Usuario asignado exitosamente');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pedidos = Pedidos::find($id);
        $pedidos->update(attributes: request()->all());
          
        return back()->with('success','Pedido modificado exitosamente');
    }
    public function DownloadWord($fecha,$turno){
        $fecha_format = Carbon::parse($fecha)->format('d-m-Y');
        if($turno == 'vacio'){
            $pedidos = Pedidos::where('deliveryDate',$fecha)->orderBy('nroOrder','asc')->get();
        }else{
            $pedidos = Pedidos::where('deliveryDate',$fecha)->where('turno',$turno)->orderBy('nroOrder','asc')->get();
        }
        $zonas = Zone::get();
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();
        foreach($zonas as $zona){
            $arrayWord = [];
            $numero_ordenes = "";
            $manana = 0;
            $tarde = 0;
            array_push($arrayWord,$zona->name);
            foreach($pedidos as $pedido){
                if($pedido->zone_id === $zona->id){
                    if($manana == 0 && $pedido->turno == 0){
                        $manana = 1;
                        array_push($arrayWord,'TURNO MAÑANA');
                    }else if ($tarde == 0 && $pedido->turno == 1){
                        array_push($arrayWord,'TURNO TARDE');
                        $tarde = 1;
                    }
                    $numero_ordenes =$numero_ordenes.$pedido->nroOrder.", ";
                    array_push($arrayWord,$pedido->nroOrder." PED ".$pedido->orderId);
                    array_push($arrayWord,$pedido->customerName." - ".$pedido->customerNumber);
                    foreach($pedido->detailpedidos as $orden){
                        array_push($arrayWord,'• '.$orden->articulo.' - '.$orden->cantidad.' unid.');
                    }
                    array_push($arrayWord,$pedido->district);
                }
            }
            $arrayWord[0] = $arrayWord[0].": ".$numero_ordenes;
            $text = $section->addText('FECHA DE ENTREGA: '.$fecha_format,array('name'=>'Arial','size' => 18,'bold' => true));
            foreach ($arrayWord as $id => $text) {
                if ($id == 0) {
                    $text = $section->addText($text,array('name'=>'Arial','size' => 11,'bold' => true));
                }elseif (strpos($text,' PED ')) {
                    $text = $section->addText($text,array('name'=>'Arial','size' => 11,'bold' => true));
                }else{
                    $text = $section->addText($text,
                    array('bold' => false),
                    array('space' => array('before' => 0, 'after' => 0)
                        )
                    );
                }
            }
            $section->addPageBreak();
        }
        


        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        if (file_exists('docs\pedidos-'.$fecha.'.docx')){
            unlink('docs\pedidos-'.$fecha.'.docx');
            $objWriter->save('docs\pedidos-'.$fecha.'.docx');
            
        }else{
            $objWriter->save('docs\pedidos-'.$fecha.'.docx');
        }
        return response()->download(public_path('docs\pedidos-'.$fecha.'.docx'));
    }
}
