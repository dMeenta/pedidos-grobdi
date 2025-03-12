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
        if($request->query("fecha")){
            $request->validate([
                'fecha' => 'required|date'
            ]);
            $dia = Carbon::parse($request->fecha)->startOfDay();
        }else{
            $dia = now()->format('Y-m-d');
        }
        $pedidos = Pedidos::whereDate('deliveryDate', $dia)->orderBy('nroOrder','asc')
        ->get();
        return view('pedidos.counter.cargar_pedido.index', compact('pedidos'))->with('i',0);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        return view('pedidos.counter.cargar_pedido.create');
    }

    /**
     * Store a newly created resource in storage.
     */
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
    /**
     * Display the specified resource.
     */
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

    /**
     * Update the specified resource in storage.
     */
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
            if(date("H:i:s") < "15:00:00" ){
                $pedidos->turno = 0;
            }else{
                $pedidos->turno = 1;
            }
        }
        $pedidos->zone_id = $request->zone_id;
        $pedidos->user_id = Auth::user()->id;
        $pedidos->save();
        return redirect()->route('cargarpedidos.index',$fecha)
                        ->with('success','Pedido modificado exitosamente');
    }

    public function uploadfile(Pedidos $pedido){
        // dd($pedido);
        return view('pedidos.counter.cargar_pedido.uploadFile',data: compact('pedido'));
    }
    public function cargarImagen(Request $request, $id){
        $request->validate([
            'paymentStatus' => 'required',
            'voucher' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        // dd(request()->all());
        $imageName = time().'.'.$request->voucher->extension();
        $request->voucher->move(public_path('images/voucher_pedidos'), $imageName);
        $pedidos = Pedidos::find($id);
        // $pedidos->name = $request->name;
        $pedidos->paymentStatus = $request->paymentStatus;
        $pedidos->paymentMethod = $request->paymentMethod;
        $pedidos->operationNumber = $request->operationNumber;
        $pedidos->voucher = 'images/voucher_pedidos/'.$imageName;
        $pedidos->save();
        return redirect()->route('cargarpedidos.index')
        ->with('success','Pedido modificado exitosamente');
    }
    public function destroy(string $id)
    {
        //
    }
}
