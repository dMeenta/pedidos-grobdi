<?php

namespace App\Http\Controllers;

use App\Http\Requests\counter\CargarPedidosUpdateRequest;
use Illuminate\Http\Request;
use App\Models\Pedidos;
use App\Models\Zone;
use App\Models\Distritos_zonas;
use App\Models\Location;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PedidosController extends Controller
{
    public function index(Request $request)
    {
        if ($request->query("fecha")) {
            $request->validate([
                'fecha' => 'required|date'
            ]);
            $dia = Carbon::parse($request->fecha)->startOfDay();
        } else {
            $dia = now()->format('Y-m-d');
        }
        $pedidos = Pedidos::whereDate('deliveryDate', $dia)->orderBy('nroOrder', 'asc')
            ->get();
        return view('counter.cargar_pedido.index', compact('pedidos'))->with('i', 0);
    }
    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $validated = $request->validate([
            'message' => 'required',
        ]);

        // Aquí puedes hacer lo que necesites con los datos validados
        // Ejemplo: guardarlos en la base de datos, enviar un correo, etc.
        $partes = explode(" PED ", $validated['message']);
        // if ($validated['message'] != '') {
        // print_r($partes);
        $acumulador_pedidos = array();
        $delimitadores = ["\n"];
        array_shift($partes);
        foreach ($partes as $parte) {
            $find   = '# PROGRAMAR';
            $bool_formato = strpos($parte, $find);
            if ($bool_formato !== false) {
                $regex = '/[' . implode('', array_map('preg_quote', $delimitadores)) . ']+/';

                // Separar el texto usando preg_split()
                $resultado = preg_split($regex, $parte);
                $order_name = '';
                $array_pedido = array();
                foreach ($resultado as $result) {
                    $text_order = strpos($result, '[');
                    if ($text_order === false) {
                        array_push($array_pedido, $result);
                    } else {
                        $order_name = $order_name . '\n' . $result;
                    }
                }
                array_unshift($array_pedido, $order_name);
                // print_r($array_pedido);
                $nro_orden = explode("#", string: $array_pedido[1]);
                $pedido_id = $nro_orden[0];
                $doctor_name = $array_pedido[3];
                $order = $array_pedido[0];

                $primera_linea = explode("-", string: $array_pedido[2]);
                $client_name = $primera_linea[0];
                $phone = $primera_linea[1];
                $address = $array_pedido[4];
                $reference = $array_pedido[5];
                $district = $array_pedido[6];
                $segunda_linea = explode("-", string: $array_pedido[7]);
                $prize = $segunda_linea[0];
                $payment_status = $segunda_linea[1];
                $estado_pedido = strpos($array_pedido[8], 'REPROGRAMADO');
                if ($estado_pedido === false) {
                    $delivery_date = $array_pedido[8];
                    $delivery_status = 'Pendiente';
                } else {
                    $tercera_linea = explode("*", string: $array_pedido[8]);
                    $delivery_date = $tercera_linea[0];
                    $delivery_status = 'Reprogramado';
                }
                if (date("H:i:s") < "15:00:00") {
                    $turno = 0;
                } else {
                    $turno = 1;
                }
                // $hoy = date('Y-m-d');
                // $hoy_hora = date('H:i:s');
                // if($hoy_hora < '12:00:00'){
                //     dd('antes de las 12');
                // }else{
                //     dd('despues de las 12');
                // }
                // $dia_sgt=date("Y-m-d", strtotime("+1 day"));
                // dd($hoy_hora);
                $array_orden_limpio = [
                    'pedido_id' => $pedido_id,
                    'doctor_name' => $doctor_name,
                    'order' => $order,
                    'client_name' => $client_name,
                    'phone' => $phone,
                    'address' => $address,
                    'reference' => $reference,
                    'district' => $district,
                    'prize' => $prize,
                    'payment_status' => $payment_status,
                    'delivery_date' => $delivery_date,
                    'delivery_status' => $delivery_status,
                    'turno' => $turno,
                ];
                array_push($acumulador_pedidos, $array_orden_limpio);
                // return back()->with('success', 'Formulario enviado correctamente!')
                // ->with('array', $array_orden_limpio); // Retorna los datos enviados
                #print($order);
                // break;
            } else {
                return back()->with('danger', 'Formato Incorrecto');
            }
        }
        $acu_creado = 0;
        $acu_modificado = 0;
        // dd($acumulador_pedidos);
        foreach ($acumulador_pedidos as $ac) {
            // dd($ac["pedido_id"]);

            $pedido = Pedidos::where('orderId', $ac["pedido_id"])->first();
            if ($pedido) {
                $acu_modificado++;
                // dd($pedido);
            } else {
                // dd($ac["payment_status"]);
                $pedido = new Pedidos();
                $pedido->orderId = $ac["pedido_id"];
                $pedido->doctorName = $ac["doctor_name"];
                $pedido->orderDescription = $ac["order"];
                $pedido->customerName = $ac["client_name"];
                $pedido->customerNumber = $ac["phone"];
                $pedido->address = $ac["address"];
                $pedido->reference = $ac["reference"];
                $pedido->district = $ac["district"];
                $pedido->turno = $ac["turno"];
                //cambiar str a decimaldd($float);
                $prize_convert = (float) filter_var($ac["prize"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $pedido->prize = $prize_convert;
                $status_convert = implode('', explode('*', $ac["payment_status"]));
                $pedido->paymentStatus = $status_convert;
                $pedido->productionStatus = 0;
                $pedido->accountingStatus = 0;
                $date_convert = preg_replace('/\s+/', '', $ac["delivery_date"]);
                $pedido->deliveryDate = $date_convert;
                //valida el ultino nro de orden del día si es igual al nro de registro que tieneel día y asigna el sgt nro
                $contador_registro = pedidos::where('deliveryDate', $date_convert)->orderBy('nroOrder', 'desc')->first();
                $ultimo_nro = 0;
                if ($contador_registro) {
                    $ultimo_nro = $contador_registro->nroOrder;
                }
                $nroOrder = $ultimo_nro + 1;
                $pedido->nroOrder = $nroOrder;

                $pedido->deliveryStatus = $ac["delivery_status"];
                $zone_id = Distritos_zonas::zonificar(substr($pedido->district, 4, -1));
                $pedido->zone_id = $zone_id;
                $pedido->user_id = Auth::user()->id;
                $pedido->save();
                $acu_creado++;
            }
        }
        return redirect()->route('cargarpedidos.index')
            ->with('success', 'Productos Creados: ' . $acu_creado . ' y exitentes: ' . $acu_modificado);
        // return back()->with('success', 'Formulario enviado correctamente!')
        // ->with('array', $acumulador_pedidos); // Retorna los datos enviados

    }
    public function show($pedido)
    {
        $pedido = Pedidos::find($pedido);
        return view('counter.cargar_pedido.show', compact('pedido'));
    }
    public function create()
    {
        return view('counter.cargar_pedido.create');
    }
    public function edit($pedido)
    {
        $pedido = Pedidos::find($pedido);
        $zonas = Zone::all();
        return view('counter.cargar_pedido.edit', compact('pedido', 'zonas'));
    }
    public function update(CargarPedidosUpdateRequest $request, $id)
    {
        $pedidos = Pedidos::find($id);
        //para enviar el parametro de la fecha en la url
        $fecha = $pedidos->deliveryDate;
        $pedidos->CustomerName = $request->customerName;
        $pedidos->doctorName = $request->doctorName;
        $pedidos->orderDescription = $request->orderDescription;
        $pedidos->address = $request->address;
        $pedidos->district = $request->district;
        $pedidos->prize = $request->prize;
        if ($pedidos->deliveryDate !== $request->deliveryDate) {
            $contador_registro = pedidos::where('deliveryDate', $request->deliveryDate)->orderBy('nroOrder', 'desc')->first();
            $ultimo_nro = 0;
            if ($contador_registro) {
                $ultimo_nro = $contador_registro->nroOrder;
            }
            $nroOrder = $ultimo_nro + 1;
            $pedidos->nroOrder = $nroOrder;
            $pedidos->deliveryStatus = "Reprogramado";
            if (date("H:i:s") < "15:00:00") {
                $pedidos->turno = 0;
            } else {
                $pedidos->turno = 1;
            }
        }
        $pedidos->zone_id = $request->zone_id;
        $pedidos->user_id = Auth::user()->id;
        $pedidos->save();
        return redirect()->route('cargarpedidos.index', $fecha)
            ->with('success', 'Pedido modificado exitosamente');
    }
    public function uploadfile(Pedidos $pedido)
    {
        // dd($pedido);
        return view('counter.cargar_pedido.uploadFile', data: compact('pedido'));
    }
    public function cargarImagen(Request $request, $id)
    {
        $request->validate([
            'paymentStatus' => 'required',
            'voucher' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        // dd(request()->all());
        $imageName = time() . '.' . $request->voucher->extension();
        $request->voucher->move(public_path('images'), $imageName);
        $pedidos = Pedidos::find($id);
        // $pedidos->name = $request->name;
        $pedidos->paymentStatus = $request->paymentStatus;
        $pedidos->paymentMethod = $request->paymentMethod;
        $pedidos->operationNumber = $request->operationNumber;
        $pedidos->voucher = 'images/' . $imageName;
        $pedidos->save();
        return redirect()->route('cargarpedidos.index')
            ->with('success', 'Pedido modificado exitosamente');
    }
    public function listPedCliente(Request $request)
    {

        $desde = $request->input('desde');
        $hasta = $request->input('hasta');
        $resultados = collect(); // colección vacía por defecto

        if ($desde && $hasta) {
            $query = DB::table('detail_pedidos')
                ->join('pedidos', 'detail_pedidos.pedidos_id', '=', 'pedidos.id')
                ->select('pedidos.customerName', 'pedidos.customerNumber', 'detail_pedidos.articulo', DB::raw('SUM(detail_pedidos.cantidad) as total_comprado'), DB::raw('MAX(pedidos.created_at) as ultima_compra'))
                ->whereNotLike('detail_pedidos.articulo', '%bolsa%')
                ->whereNotLike('detail_pedidos.articulo', '%delivery%')
                ->groupBy('pedidos.customerName', 'pedidos.customerNumber', 'detail_pedidos.articulo');
            $query->whereBetween('pedidos.created_at', [$desde, $hasta]);

            $resultados = $query->get();
        }

        return view('pedidos.jefecomercial.ventasxcliente', compact('resultados', 'desde', 'hasta'));
    }

    public function showDeliveryStates($id)
    {
        $pedido = Pedidos::findOrFail($id);

        $states = $pedido->deliveryStates()
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($state) {
                return [
                    'id' => $state->id,
                    'state' => $state->state,
                    'created_at' => $state->created_at,
                    'created_at_formatted' => $state->created_at_formatted,
                    'foto_domicilio' => $state->foto_domicilio ? [
                        'url' => asset($state->foto_domicilio),
                        'datetime' => $state->datetime_foto_domicilio->format('d/m/Y H:i'),
                        'location' => $state->getFotoData(Location::TYPE_FOTO_DOMICILIO)
                    ] : null,
                    'foto_entrega' => $state->foto_entrega ? [
                        'url' => asset($state->foto_entrega),
                        'datetime' => $state->datetime_foto_entrega->format('d/m/Y H:i'),
                        'location' => $state->getFotoData(Location::TYPE_FOTO_ENTREGA)
                    ] : null,
                    'receptor_info' => $state->receptor_firma && $state->receptor_nombre ? [
                        'nombre' => $state->receptor_nombre,
                        'firma' => asset($state->receptor_firma),
                    ] : null
                ];
            });

        return response()->json([
            'success' => true,
            'states' => $states
        ]);
    }
}
