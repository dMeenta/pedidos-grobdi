<?php

namespace App\Http\Controllers\pedidos\counter;

use App\Http\Controllers\Controller;
use App\Http\Requests\counter\CargarPedidosUpdateRequest;
use App\Imports\DetailPedidosImport;
use App\Imports\PedidosImport;
use App\Models\Pedidos;
use App\Models\Zone;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class CargarPedidosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $ordenarPor = $request->get('sort_by', 'orderId'); // campo por defecto
        $direccion = $request->get('direction', 'asc'); // dirección por defecto
        if($request->query("fecha")){
            $request->validate([
                'fecha' => 'required|date'
            ]);
            $dia = Carbon::parse($request->fecha)->startOfDay();
        }else{
            $dia = now()->format('Y-m-d');
        }
        if($request->filtro){
            $filtro = $request->filtro;
        }else{
            $filtro = "deliveryDate";
        }
        $pedidos = Pedidos::whereDate($filtro, $dia)->orderBy($ordenarPor, $direccion)
        ->get();
        return view('pedidos.counter.cargar_pedido.index', compact('pedidos', 'ordenarPor', 'direccion'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        return view('pedidos.counter.cargar_pedido.create');
    }

    public function store(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'archivo' => 'required|mimes:xlsx,xls',
        ]);

        // Get the uploaded file
        $file = $request->file('archivo');

        // Process the Excel file
        $pedidoImport = new PedidosImport;
        $excel = Excel::import($pedidoImport, $file);
        return redirect()->back()->with($pedidoImport->key, $pedidoImport->data);
    }
    public function cargarExcelArticulos(Request $request){
        // Validate the uploaded file
        $request->validate([
            'archivo' => 'required|mimes:xlsx,xls',
        ]);

        // Get the uploaded file
        $file = $request->file('archivo');
        $pedidodetailImport = new DetailPedidosImport;
        // Process the Excel file
        Excel::import($pedidodetailImport, $file);
        return redirect()->back()->with($pedidodetailImport->key, $pedidodetailImport->data);
    }
    public function sincronizarDoctoresPedidos(){
        return redirect()->back()->with('success','Pedidos sincronizados con doctores');
    }
    public function show($pedido){
        $pedido = Pedidos::find($pedido);
        return view('pedidos.counter.cargar_pedido.show', compact('pedido'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($pedido){
        $pedido = Pedidos::find($pedido);
        $zonas = Zone::all();
        return view('pedidos.counter.cargar_pedido.edit',compact('pedido','zonas'));
    }

    public function DownloadWord(Request $request){
        $fecha = $request->fecha;
        $fecha_format = Carbon::parse($fecha)->format('d-m-Y');
        $turno = $request->turno;
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
    public function update(CargarPedidosUpdateRequest $request, $id)
    {
        $pedidos = Pedidos::find($id);
        //para enviar el parametro de la fecha en la url
        $fecha = $pedidos->deliveryDate;
        $pedidos->CustomerName = $request->customerName;
        $pedidos->doctorName = $request->doctorName;
        $pedidos->address = $request->address;
        $pedidos->district = $request->district;
        $pedidos->prize = $request->prize;
        if($pedidos->deliveryDate !== $request->deliveryDate){
            $pedidos->deliveryDate = $request->deliveryDate;
            $contador_registro = pedidos::where('deliveryDate',$request->deliveryDate)->orderBy('nroOrder','desc')->first();
            $ultimo_nro = 0;
            if($contador_registro){
                $ultimo_nro = $contador_registro->nroOrder;
            }
            $nroOrder = $ultimo_nro +1;
            $pedidos->nroOrder = $nroOrder;
            $pedidos->deliveryStatus = "Reprogramado";
            // if(date("H:i:s") < "15:00:00" ){
            //     $pedidos->turno = 0;
            // }else{
            //     $pedidos->turno = 1;
            // }
            $pedidos->turno = 0;
        }
        $pedidos->zone_id = $request->zone_id;
        $pedidos->user_id = Auth::user()->id;
        $pedidos->save();
        return redirect()->route('cargarpedidos.index',$fecha)
                        ->with('success','Pedido modificado exitosamente');
    }
    public function actualizarTurno(Request $request, $id)
    {
        $pedidos = Pedidos::find($id);
        $pedidos->update(attributes: request()->all());
          
        return back()->with('success','Turno modificado exitosamente');
    }
    public function uploadfile(Pedidos $pedido){
        $images = explode(",",$pedido->voucher);
        $nro_operaciones = explode(",",$pedido->operationNumber);
        $recetas = explode(",",$pedido->receta);
        $array_voucher = [];
        foreach ($images as $key => $voucher) {
            array_push($array_voucher,['nro_operacion'=>$nro_operaciones[$key],'voucher'=>$voucher]);
        }
        return view('pedidos.counter.cargar_pedido.uploadFile',data: compact('pedido','array_voucher','recetas'));
    }
    public function actualizarPago(Request $request, $id){
        
        $request->validate([
            'paymentStatus' => 'required',
            'paymentMethod' => 'required',
        ]);
        $pedidos = Pedidos::find($id);
        $pedidos->paymentStatus = $request->paymentStatus;
        $pedidos->paymentMethod = $request->paymentMethod;
        $pedidos->save();
        return back()->with('success','Pedido modificado exitosamente');
    }
    public function cargarImagen(Request $request, $id){

        $request->validate([
            'operationNumber' => 'required',
            'voucher' => 'required|image|mimes:jpeg,png,jpg,gif|max:3048',
        ]);
        // dd(request()->all());
        $pedidos = Pedidos::find($id);
        $imageName =$pedidos->orderId.'_'.time().'.'.$request->voucher->extension();
        $request->voucher->move(public_path('images/voucher_pedidos'), $imageName);
        
        if($pedidos->voucher){
            $pedidos->voucher = $pedidos->voucher.',images/voucher_pedidos/'.$imageName;
            $pedidos->operationNumber = $pedidos->operationNumber.','.$request->operationNumber;
        }else{
            $pedidos->voucher = 'images/voucher_pedidos/'.$imageName;
            $pedidos->operationNumber = $request->operationNumber;
        }
        $pedidos->save();
        return back()->with('success','Imagen cargada exitosamente');
    }
    public function cargarImagenReceta(Request $request, $id){
        $request->validate([
            'receta' => 'required',
            'receta.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ], [
            'receta.required' => 'Debes seleccionar al menos una imagen.',
            'receta.*.image' => 'Cada archivo debe ser una imagen.',
            'receta.*.mimes' => 'Solo se permiten imágenes con formato jpeg, png, jpg, gif o webp.',
            'receta.*.max' => 'Cada imagen no puede superar los 2 MB.',
        ]);
        $pedidos = Pedidos::find($id);
        if ($request->hasFile('receta')) {
            $urls = '';
            $contador = 1;
            foreach ($request->file('receta') as $imagen) {
                $imageNameReceta = $pedidos->orderId.'_'.$contador.'_'.time().'.'.$imagen->extension();
                ++$contador;
                $imagen->move(public_path('images/receta_pedidos'), $imageNameReceta);
                if($urls){
                    $urls = $urls .','.'images/receta_pedidos/'.$imageNameReceta;
                }else{
                    $urls = 'images/receta_pedidos/'.$imageNameReceta;
                }
            }
        }
        $pedidos->receta = $urls;
        $pedidos->save();
        return back()->with('success','Receta cargada exitosamente');
    }
    public function destroy(string $id)
    {
        //
    }
    public function eliminarFotoVoucher(Request $request,$id){
        $pedido = Pedidos::find($id);
        $array_voucher = explode(',',$pedido->voucher);
        $nro_operaciones = explode(",",$pedido->operationNumber);
        $urls = '';
        $text_nro_operacion = '';
        foreach($array_voucher as $key => $voucher){
            if($voucher == $request->voucher){
                if (file_exists($voucher)) {
                    unlink($voucher);
                }
                unset($nro_operaciones[$key]);
                unset($array_voucher[$key]);
            }
        }
        foreach($array_voucher as $key => $voucher){
            if(count($array_voucher)>1){
                if($urls){
                    $urls = $urls .','.$voucher;
                    $text_nro_operacion = $text_nro_operacion .','.$nro_operaciones[$key];
                }else{
                    $urls = $voucher;
                    $text_nro_operacion = $nro_operaciones[$key];
                }
            }else{
                $urls = $voucher;
                $text_nro_operacion = $nro_operaciones[$key];
            }
        }
        $pedido->voucher = $urls;
        $pedido->operationNumber = $text_nro_operacion;
        $pedido->save();

        return back()->with('success','imagen eliminada exitosamente');
    }
}
