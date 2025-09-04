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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        
        // Obtener todas las zonas para el filtro
        $zonas = Zone::orderBy('name')->get();
        
        // Construir query base
        $query = Pedidos::where('deliveryDate', $fecha);
        
        // Filtro por turno
        if($request->turno){
            $turno = $request->turno;
            $query = $query->where('turno', $turno);
        }else{
            $turno = 0;
            $query = $query->where('turno', 0);
        }
        
        // Filtro por zona
        if($request->zona_id && $request->zona_id != ''){
            $query = $query->where('zone_id', $request->zona_id);
        }
        
        $pedidos = $query->orderBy('nroOrder','asc')->latest()->get();
        
        return view('pedidos.laboratorio.index', compact('pedidos','turno','zonas'));
    }
    
    public function show($id){
        try {
            Log::info("Buscando pedido con ID: $id");
            
            $pedido = Pedidos::with(['detailpedidos' => function ($query) {
                $query->where('articulo', 'not like', '%bolsa%')
                    ->where('articulo', 'not like', '%delivery%');
            }])->findOrFail($id);

            Log::info("Pedido encontrado con " . $pedido->detailpedidos->count() . " detalles");

            $bases = Bases::lista();
            // dd($pedido->detailpedidos);
            $array_pedido = [];
            
            // Verificar si hay detailpedidos antes de iterar
            if ($pedido->detailpedidos && $pedido->detailpedidos->count() > 0) {
                foreach($pedido->detailpedidos as $detalle){
                    $found = false;
                    foreach ($bases as $base => $contenido) {
                        if(strpos($detalle->articulo,$base)!==false){
                            array_push($array_pedido,[
                                'articulo'=>$detalle->articulo,
                                'cantidad'=>$detalle->cantidad,
                                'clasificacion'=>$contenido['clasificacion'],
                                'estado_produccion' => $detalle->estado_produccion ?? 0
                            ]);
                            $found = true;
                            break;
                        }
                    }
                    
                    // Si no se encontró en bases, agregar sin clasificación
                    if (!$found) {
                        array_push($array_pedido,[
                            'articulo'=>$detalle->articulo,
                            'cantidad'=>$detalle->cantidad,
                            'clasificacion'=>'Sin clasificación',
                            'estado_produccion' => $detalle->estado_produccion ?? 0
                        ]);
                    }
                }
            }
            
            Log::info("Productos procesados: " . count($array_pedido));
            
            // Agregar array_pedido al objeto de respuesta
            $pedido->productos_procesados = $array_pedido;
            
            return response()->json($pedido);
        } catch (\Exception $e) {
            Log::error('Error en show de PedidoslabController: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return response()->json(['error' => 'Error al cargar el detalle del pedido'], 500);
        }
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
                    preg_match_all('/(.*?)(\d+)\s*(MG|UI|ML|MCG|%)/i', $detalle->articulo, $matches, PREG_SET_ORDER);

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
    public function asignarmultipletecnico(Request $request){
        $ids_detalle = $request->input('detalle', []);
        $tecnico_id = $request->input('usuario_produccion_id');
        
        if (empty($ids_detalle)) {
            return back()->with('error', 'No seleccionaste ningún producto.');
        }

        if (!$tecnico_id) {
            return back()->with('error', 'Debes seleccionar un técnico.');
        }

        DetailPedidos::whereIn('id', $ids_detalle)->update(['usuario_produccion_id' => $tecnico_id]);

        return back()->with('success', 'Ordenes asignadas correctamente.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'productionStatus' => 'required|in:0,1,2',
            'observacion_laboratorio' => 'nullable|string|max:500',
            'fecha_reprogramacion' => 'nullable|date|after:today',
        ]);

        $pedido = Pedidos::findOrFail($id);
        
        // Si es reprogramado (2), la fecha de reprogramación es obligatoria
        if ($request->productionStatus == 2 && !$request->fecha_reprogramacion) {
            return back()->with('error', 'La fecha de reprogramación es obligatoria cuando el estado es "Reprogramado".');
        }
        
        // Actualizar campos
        $updateData = [
            'productionStatus' => $request->productionStatus,
            'observacion_laboratorio' => $request->observacion_laboratorio,
        ];
        
        // Solo agregar fecha de reprogramación si es reprogramado (2)
        if ($request->productionStatus == 2) {
            $updateData['fecha_reprogramacion'] = $request->fecha_reprogramacion;
        } else {
            // Limpiar fecha de reprogramación si no es reprogramado
            $updateData['fecha_reprogramacion'] = null;
        }
        
        $pedido->update($updateData);
        
        $mensaje = match($request->productionStatus) {
            1 => 'Pedido aprobado exitosamente',
            2 => 'Pedido reprogramado exitosamente', 
            0 => 'Pedido marcado como pendiente',
            default => 'Estado del pedido actualizado exitosamente'
        };
          
        return back()->with('success', $mensaje);
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

    /**
     * Cambio masivo de estado de pedidos a Preparado
     */
    public function cambioMasivo(Request $request)
    {
        try {
            // Log para debug - datos recibidos
            Log::info('Cambio masivo - datos recibidos', [
                'all_data' => $request->all(),
                'method' => $request->method(),
                'has_csrf' => $request->has('_token'),
                'user' => Auth::user()->name ?? 'Sistema'
            ]);

            // Validación paso a paso para mejor diagnóstico
            if (!$request->has('pedidos_ids') || empty($request->pedidos_ids)) {
                Log::error('Cambio masivo - falta pedidos_ids', ['request' => $request->all()]);
                return response()->json([
                    'success' => false,
                    'message' => 'No se enviaron los IDs de pedidos'
                ], 422);
            }

            if (!$request->has('accion_masiva') || $request->accion_masiva !== 'preparado') {
                Log::error('Cambio masivo - falta accion_masiva', ['request' => $request->all()]);
                return response()->json([
                    'success' => false,
                    'message' => 'Acción masiva no válida'
                ], 422);
            }

            // Convertir string de IDs a array
            $pedidosIds = array_filter(explode(',', $request->pedidos_ids));
            
            if (empty($pedidosIds)) {
                Log::error('Cambio masivo - IDs vacíos', ['pedidos_ids' => $request->pedidos_ids]);
                return response()->json([
                    'success' => false,
                    'message' => 'No se seleccionaron pedidos válidos'
                ], 422);
            }

            Log::info('Cambio masivo - IDs procesados', ['pedidos_ids' => $pedidosIds]);

            // Buscar pedidos que existen y NO están preparados
            $pedidos = Pedidos::whereIn('id', $pedidosIds)
                             ->whereIn('productionStatus', [0, 2]) // Pendientes (0) y Reprogramados (2)
                             ->get();

            Log::info('Cambio masivo - pedidos encontrados', [
                'total_solicitados' => count($pedidosIds),
                'encontrados' => $pedidos->count(),
                'pedidos_data' => $pedidos->map(function($p) {
                    return [
                        'id' => $p->id,
                        'orderId' => $p->orderId,
                        'status' => $p->productionStatus
                    ];
                })->toArray()
            ]);

            if ($pedidos->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se encontraron pedidos pendientes o reprogramados para actualizar'
                ], 422);
            }

            $cantidadActualizada = 0;
            
            // Usar transacción para asegurar consistencia
            DB::beginTransaction();
            
            foreach ($pedidos as $pedido) {
                $updateData = [
                    'productionStatus' => 1, // Cambiar a Preparado
                    'fecha_reprogramacion' => null, // Limpiar fecha de reprogramación si existía
                ];
                
                // Agregar observación si se proporcionó
                if ($request->observacion_masiva) {
                    $updateData['observacion_laboratorio'] = $request->observacion_masiva;
                }
                
                $pedido->update($updateData);
                $cantidadActualizada++;
            }
            
            DB::commit();
            
            // Log de la acción
            Log::info('Cambio masivo de estado realizado', [
                'usuario' => Auth::user()->name ?? 'Sistema',
                'pedidos_actualizados' => $cantidadActualizada,
                'pedidos_ids' => $pedidosIds,
                'observacion' => $request->observacion_masiva
            ]);
            
            return response()->json([
                'success' => true,
                'message' => "Se actualizaron {$cantidadActualizada} pedido(s) a estado Preparado exitosamente",
                'cantidadActualizada' => $cantidadActualizada
            ]);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación: ' . implode(', ', $e->validator->errors()->all())
            ], 422);
            
        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error('Error en cambio masivo de estado', [
                'error' => $e->getMessage(),
                'pedidos_ids' => $request->pedidos_ids ?? 'no definido',
                'usuario' => Auth::user()->name ?? 'Sistema'
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Ocurrió un error inesperado. Por favor, intente nuevamente.'
            ], 500);
        }
    }
}
